 <?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

//front-website

Route::group(['namespace' =>'Front'],function(){

    Route::get('/client-login','AuthController@login');
    Route::post('/logined','AuthController@loginSave');
    Route::get('/website','MainController@home');
    Route::get('/about','MainController@about');
    Route::get('/who-we-are','MainController@whoWe');
    Route::get('/client-register','AuthController@register');
    Route::post('/registered','AuthController@registerSave');
    Route::get('/reset-password','AuthController@resetPassword');
    Route::post('/password-reset' ,'AuthController@passwordReset');
    Route::get('/new-password','AuthController@newPassword');
    Route::get('post/{post}' ,'MainController@postShow');
    Route::get('posts' ,'MainController@posts');
    Route::get('more-posts/{id}' ,'MainController@morePosts')->name('more-posts');
    Route::get('donation/{donation}' ,'MainController@donationShow');
    Route::get('donations' ,'MainController@donations');

    Route::group(['middleware' => 'auth:client-web'],function(){
      Route::get('/logout','AuthController@logout');
      Route::get('notification-setting' ,'AuthController@notificationSetting');
      Route::post('notification-update' ,'AuthController@updateNotificationSettings');
      Route::get('notifications' ,'AuthController@notifications');
      Route::post('toggle-favourite' ,'MainController@toggleFavourite')->name('toggle-favourite');
      Route::get('fav-posts' ,'MainController@favouritePosts');
      Route::post('/password-changed' ,'AuthController@passwordChanged');
      Route::get('/profile','AuthController@profile');
      Route::post('/profile-set','AuthController@profileSet');
      Route::get('/contact','MainController@contact');
      Route::post('/contact-created','MainController@contactSave');
      Route::get('/donation-create','MainController@donationCreate');
      Route::post('/donation-save','MainController@donationSave');
    });
});

//admin

Route::group(['middleware' =>['auth', 'auto-check-permission'],'prefix' => 'admin'],function()
{
  Route::resource('/governorate','GovernorateController' );
  Route::resource('/city','CityController' );
  Route::resource('/category','CategoryController' );
  Route::resource('/post','PostController' );
  Route::resource('/client','ClientController' );
  Route::resource('/setting','SettingController' );
  Route::resource('/contactus','ContactUsController' );
  Route::resource('/donation','DonationController' );
  Route::resource('/role','RoleController' );
  Route::resource('/user','UserController' );

  Route::get('/client/{id}/active','ClientController@active' );
  Route::get('/client/{id}/deactive','ClientController@deactive' );

  Route::get('/change-password','UserController@changePassword')->name('user.change-password');
  Route::post('/update-password','UserController@updatePassword')->name('user.update-password');;

  Route::get('/home', function () {
      return view('admin-home');
    })->name('admin.home');
});

Auth::routes();
