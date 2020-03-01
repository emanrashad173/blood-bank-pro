<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Client;
use App\Models\DonationRequest;
use App\Models\Contact;
use Validator;



class MainController extends Controller
{
    //home

    public function home(Request $request)
    {
       $posts = Post::latest()->take(9)->get();
       $donations = DonationRequest::where(function($query) use($request){
            if ($request->input('city_id')) {
              $query->where('city_id',$request->city_id);
            }
            if ($request->input('blood_type_id')) {
              $query->where('blood_type_id',$request->blood_type_id);
            }
          })->latest()->paginate(4);

    return view('front.home',compact('posts','donations'));
    }

   //about

    public function about()
    {
      return view('front.about');
    }

    //whoWe

    public function whoWe()
    {
      return view('front.who_we');
    }

    //contact

    public function contact(Contact $model)
    {
      return view('front.contact',compact('model'));
    }

   //contactSave

    public function contactSave(Request $request)
    {

      $validator = $request->validate([
         'name' => 'required',
         'phone' => 'required|unique:clients',
         'email' => 'required|unique:clients',
         'subject' => 'required',
         'message' => 'required',
        ]);

     $contact = Contact::create($request->all());
     $contact->save();
     return redirect('/website');
    }

    //postShow

    public function postShow($id)
    {
      $post = Post::find($id);
      return view('front.post',compact('post'));
    }

   //posts

    public function posts(Request $request)
    {
      $posts = Post::where(function($query) use($request){
           if ($request->input('category_id')) {
             $query->where('category_id',$request->category_id);
           }
           if ($request->input('search_by_hospital_name')) {
             $query->where(function($query) use($request){
               $query->where('hospital_name','like','%'.$request->search_by_name.'%');
             });
           }
         })->latest()->paginate(5);

     return view('front.posts',compact('posts'));
   }

    //toggleFavourite
    public function toggleFavourite(Request $request)
    {
      $toggle = auth()->user()->posts()->toggle($request->post_id);
      return responseJson(1,'success' ,$toggle);
    }

    //favouritePosts

    public function favouritePosts()
    {
      $client = Client::find(auth()->user()->id);
      $favposts = auth()->user()->posts()->paginate(4);

      return view('front.fav-post',compact('favposts'));
    }

   //donations

    public function donations(Request $request)
    {
      $donations = DonationRequest::where(function($query) use($request){
           if ($request->input('city_id')) {
             $query->where('city_id',$request->city_id);
           }
           if ($request->input('blood_type_id')) {
             $query->where('blood_type_id',$request->blood_type_id);
           }
         })->latest()->paginate(10);
      return view('front.donations',compact('donations'));
    }

    //donationShow

    public function donationShow($id)
    {
      $donation = DonationRequest::find($id);
      return view('front.donation',compact('donation'));
    }

    //donationCreate

    public function donationCreate(DonationRequest $model)
    {
      return view('front.donation-form',compact('model'));
    }

   //donationSave

    public function donationSave(Request $request)
    {
      $request->validate([
        'patient_name' =>['required'],
        'patient_age' =>['required'],
        'blood_type_id' => ['required','exists:blood_types,id'],
        'bags_num' =>['required'],
        'hospital_name' => ['required'] ,
        'hospital_address' => ['required'],
        'city_id' => ['required','exists:cities,id'],
        'phone' => ['required','digits:11'],
        ]);

     // $donationRequest =DonationRequest::create($request->all());
     // $donationRequest->client_id= auth('client-web')->clients()->id;
     //
     // $donationRequest->save();


     $donationRequest =$request->user()->donationRequests()->create($request->all());

     $clientsIds = $donationRequest->city->clients()
      ->whereHas('bloodTypes' ,function($q) use($request ,$donationRequest)
     {
       $q->where('blood_types.id',$donationRequest->blood_type_id);
     })->pluck('clients.id')->toArray();
     //create notification
     if(count($clientsIds))
     {

       $notification = $donationRequest->notification()->create([
         'title' => 'يوجد حالة تبرع' ,
         'content' => 'فصيلة التبرع'.$donationRequest->bloodType->name .'المدينة'.$donationRequest->city->name
       ]);

      //attach client
      $u = $notification->clients()->attach($clientsIds);
dd($u);
     return redirect('/website');
    }
  }
}
