<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Client;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;
use App\Models\DonationRequest;
use App\Models\Notification;
use App\Models\Governorate;
use App\Models\BloodType;
use App\Models\Token;







class AuthController extends Controller
{
  //Register

    public function register(Request $request)
    {

          $validator = validator()->make($request->all(),[
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required|unique:clients',
            'password'=>'required|confirmed',
            'dob'=>'required',
            'last_donation_date'=>'required',
            'blood_type_id'=>'required',
            'city_id'=>'required',
          ]);

          if($validator->fails())
          {
              return responseJson(0,$validator->errors()->first(),$validator->errors());
          }

          $request->merge(['password'=>bcrypt($request->password)]);
          $client=Client::create($request->all());
          $client->api_token = Str::random(60);
          $client->save();

          return responseJson(1,'successed',['api_token'=>$client->api_token,'client'=>$client]);
    }

    //login

    public function login(Request $request)
    {
      $validator = Validator::make($request->all(),[
        'phone'=>'required',
        'password'=>'required'
      ]);

     $client=Client::where('phone',$request->phone)->first();

      if($client)
      {
         if(Hash::check($request->password,$client->password)){
             return responseJson(1,'تم التسجيل',[
               'api_token'=>$client->api_token,
               'client'=>$client
             ]);

         }
         else {
             return responseJson(0,'بيانات عير صحيحة');
         }
      }
      else {
        return responseJson(0,'بيانات عير صحيحة');
      }
    }

     //Reset-password

     public function resetPassword(Request $request)
     {

         $user = Client::where('phone', $request->phone)->first();

         if($user)
         {
           $code = rand(1111,9999);
           $update = $user->update(['pin_code' => $code]);
           if($update)
           {
             Mail::to($user->email)
                 ->bcc("eman123456eman123@gmail.com")
                 ->send(new ResetPassword($code));

             return responseJson(1,'برجاء فحص بريدك' ,['pin_code_for_test' =>$code]);

           }
           else {
             return responseJson(0,'حدث خطا','حاول مرة اخري');
           }
         }
         else {
           return responseJson(0,'لا يوجد الحساب');
         }
     }

     //New-password

      public function newPassword (Request $request)
      {

        $validator = Validator::make($request->all(),[
          'pin_code' =>'required',
          'phone' => 'required',
          'password'=> 'required|confirmed'
        ]);

        if($validator->fails())
        {
          $data =$validator ->errors();
          return responseJson(0,$validator->errors()->first(),$data);
        }
        $user = Client::where('pin_code' ,$request->pin_code)->where('pin_code' ,'!=',0)
        ->where('phone',$request->phone)->first();
        if ($user)
        {
            $user->password = bcrypt($request->password);
            $user->pin_code = null ;

            if ($user->save())
            {
               return responseJson(1,'تم تغيير كلمة المرور بنجاح');
            }
            else {
              return responseJson(0,'حدث خطا','حاول مرة اخري');
            }
         }else {
           return responseJson(0,'هذا الكود غير صالح');
        }
      }

      //Profile

      public function profile(Request $request)
      {
        $user =$request ->user();
        $user->update($request->except('password'));
        if($request->has('password'))
        {
          $user->password =bcrypt($request->password);
          $user->save();
        }
        return responseJson(1,'success',$user);

        //
        // if ($user)
        // {
        //     $user->name =$request->name;
        //     $user->email =$request->email;
        //     $user->dob =$request->dob;
        //     $user->blood_type_id =$request->blood_type_id;
        //     $user->last_donation_date =$request->last_donation_date;
        //     $user->city_id =$request->city_id;
        //     $user->phone =$request->phone;
        //     $user->password =bcrypt($request->password);
        //   }
        //     if($user->save())
        //     {
        //
        //       return responseJson(1,'success',$user);
        //     }
        //
        //     else {
        //       return responseJson(0,'fail');
        //     }
        //
        //   return responseJson(0,'fail');

      }

      //GetNotificationSettings

      public function getNotificationSettings(Request $request)
      {
        $clientGovernate = $request->user()->governorates()->pluck('governorates.id')->toArray();
        $clientBloodType = $request->user()->bloodTypes()->pluck('blood_types.id')->toArray();

        $data = [
          'governorates' => $clientGovernate ,
          'bloodtype'     => $clientBloodType
        ];
        return responseJson(1,'success',$data);
      }


      //updateNotificationSettings

      public function updateNotificationSettings(Request $request)
      {
        $validator = Validator::make($request->all(),[
          'governorates' => 'required|array' ,
          'governorates.*' => 'exists:governorates,id' ,
          'bloodtypes' => 'required|array'
        ]);

        if($validator->fails())
        {
            $data = $validator->errors();
            return responseJson(0,$validator->errors()->first(),$data);
        }
        $request->user()->governorates()->sync($request->governorates);
        $request->user()->bloodTypes()->sync($request->bloodtypes);

        return responseJson(1,'success');
      }


      //Notifications
      public function notifications(Request $request)
      {
        $notifications = $request->user()->notifications()->paginate(10);
        return responseJson(1 ,'success', $notifications);
      }


      //RegisterToken

      public function registerToken(Request $request)
      {
            $validator = Validator::make($request->all(),[
              'token' => 'required' ,
              'platform' => 'required|in:android,ios'
            ]);

            if($validator->fails())
            {
                $data = $validator->errors();
                return responseJson(0,$validator->errors()->first(),$data);
            }

            Token::where('token',$request->token)->delete();
            $request->user()->tokens()->create($request->all());

            return responseJson(1,'تم النسجيل بنجاح');
      }

      //RemoveToken

      public function removeToken(Request $request)
      {
          $validator = Validator::make($request->all(),[
            'token' => 'required',
          ]);

          if($validator->fails())
          {
            $data = $validator->errors();
            return responseJson(0,$validator->errors()->first(),$data);
          }

          Token::where('token',$request->token)->delete();
          return responseJson(1,'تم الحذف بنجاح');
      }



}
