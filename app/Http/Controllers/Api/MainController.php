<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Governorate;
use App\Models\City;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\DonationRequest;
use App\Models\Client;
use App\Models\ClientPost;
use App\Models\Token;
use App\Models\Post;




class MainController extends Controller
{
      //governorates

      public function governorates()
      {
        $governorates = Governorate::all();
        return responseJson(1 ,'success', $governorates);
      }

      //cities

      public function cities(Request $request)
      {
        $cities = City::where(function($query) use($request){
          if($request->has('governorate_id'))
          {
            $query->where('governorate_id',$request->governorate_id);
          }
          })->get();
        return responseJson(1 , 'success',$cities);
      }

      //bloodTypes

      public function bloodTypes()
      {
        $bloodTypes= BloodType::all();
        return responseJson(1 ,'success', $bloodTypes);
      }

      //categories

      public function categories()
      {
        $categories= Category::all();
        return responseJson(1 ,'success', $categories);
      }

       //contactUs

      public function contactUs(Request  $request)
      {
        //validation_errors
        // create contact
        $validator = Validator()->make($request->all(), [

           'name' => 'required',
           'phone' => 'required|unique:clients',
           'email' => 'required|unique:clients',
           'subject' => 'required',
           'message' => 'required',

          ]);

       if($validator->fails())
       {
         return responseJson(0, $validator->errors()->first() ,  $validator->errors());
       }

       $contact = Contact::create($request->all());
       $contact->save();

       return responseJson(1, 'success');
      }

     //settings

      public function settings()
      {
        $settings= Setting::first();
        return responseJson(1 ,'success', $settings);
      }

      // donationRequest

      public function donationRequestCreate(Request $request)
      {
        $validator = Validator::make($request->all(),[
          'patient_name' =>'required',
          'patient_age' =>'required:digits',
          'blood_type_id' => 'required|exists:blood_types,id',
          'bags_num' =>'required:digits',
          'hospital_name' => 'required' ,
          'hospital_address' => 'required',
          'city_id' => 'required:exists:cities,id',
          'phone' => 'required|digits:11',
          ]);
          if($validator->fails())
          {
            return responseJson(0,$validator->errors()->first(),$validator->errors());
          }
          $donationRequest =$request->user()->donationRequests()->create($request->all());

          $clientsIds = $donationRequest->city->governorate->clients()
           ->whereHas('bloodTypes' ,function($q) use($request ,$donationRequest)
          {
            $q->where('blood_types.id',$donationRequest->blood_type_id);
          })->pluck('clients.id')->toArray();

          //create notification
          if(count($clientsIds))
          {
            $notification = $donationRequest->notification()->create([
              'title' => 'يوجد حالة تبرع' ,
              'content' =>$donationRequest->blood_type_id . 'فصيلة التبرع'
            ]);

           //attach client
            $notification ->clients()->attach($clientsIds);

            //get tokens
            $tokens = Token::whereIn('client_id' ,$clientsIds)->where('token','!=' ,null)->pluck('token')->toArray();

            if(count($tokens))
            {
              $title = $notification->title;
              $body = $notification->content;
              $date = [
                  'donation_request_id' => $donationRequest->id
              ];
              $send = notifyByFirebase($title, $body, $tokens, $date);
              info($send);
              info("firebase result: " .$send);
            }
          return responseJson(1,'تم الاضافة بنجاح',$donationRequest->load('city.governorate','bloodType'));

        }
       }

        //get donation request

        public function donationRequest(Request $request )
        {
          $donationRequest = DonationRequest::with('city.governorate','bloodType')->find($request->id);
          return responseJson(1 , 'success',$donationRequest);
        }

        //donationRequests

        public function donationRequests(Request $request)
        {
            $donationRequests = DonationRequest::with('city.governorate','bloodType')->
            where(function($donation) use($request){
             if ($request->has('governorate_id')) {
                $donation->whereHas('city',function($city) use($request){
                  $city->where('governorate_id',$request->governorate_id);
                  // $city->whereHas('governorate',function($governorate) use($request){
                  //   $governorate->where('name','like','%'.$request->keyword.'%')
                  // });
                });
              }

              if ($request->has('blood_type_id')) {
                $query->where('blood_type_id',$request->blood_type_id);
              }

            })->paginate(5);
            return responseJson(1 ,'success',$donationRequests);
        }

      //togglefavourite

      public function getIsFavourite(Request $request)
      {
        $request->validate([
            'id' => 'required|exists:posts,id',
        ]);

       $post = Post::find($request->id);
       $request->user()->posts()->toggle($request->id);

       return responseJson(1 ,'success', $post);

      }

      //list of favourite

      public function favourites(Request $request)
      {

        // $client = Client::find($request->id);
        $favposts = $request->user()->posts()->paginate();

        return responseJson(1 ,'success', $favposts);
      }


        //get posts

        public function posts(Request $request)
        {
          $posts = Post::where(function($query) use($request){
            if ($request->has('category_id')) {
              $query->where('category_id',$request->category_id);
            }
            if ($request->has('keyword')) {
              $query->where(function($query) use($request){
                $query->where('title','like','%'.$request->keyword.'%');
                $query->orWhere('content','like','%'.$request->keyword.'%');
              });
            }
          })->paginate(5);
          return responseJson(1 ,'success', $posts);
        }

      //get one post

      public function post(Request $request )
      {
        $post = Post::find($request->id);

        return responseJson(1 , 'success',$post);
      }


}
