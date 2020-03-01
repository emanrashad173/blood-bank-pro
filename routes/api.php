<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

 Route::group(['prefix'=>'v1','namespace'=>'Api'],function(){
      Route::get('governorates' ,'MainController@governorates');
      Route::get('cities' ,'MainController@cities');
      Route::get('blood-types' ,'MainController@bloodTypes');
      Route::get('categories' ,'MainController@categories');
      Route::post('contact-us' ,'MainController@contactUs');
      Route::get('settings' ,'MainController@settings');
      Route::post('register' ,'AuthController@register');
      Route::post('login' ,'AuthController@login')->name('login');
      Route::post('resetpassword' ,'AuthController@resetPassword');
      Route::post('newpassword' ,'AuthController@newPassword');


      Route::group(['middleware' => 'auth:api'],function(){
        Route::get('posts','MainController@posts');
        Route::get('post','MainController@post');
        Route::get('list-of-favourite','MainController@favourites');
        Route::get('get-is-favourite','MainController@getIsFavourite');
        Route::get('newpassword' ,'AuthController@newPassword');
        Route::post('create-donation-request','MainController@donationRequestCreate');
        Route::get('fav-posts','AuthController@favourites');
        Route::post('profile','AuthController@profile');
        Route::post('register-token','AuthController@registerToken');
        Route::post('remove-token','AuthController@removeToken');
        Route::get('notifications','AuthController@notifications');
        Route::get('donation-requests','MainController@donationRequests');
        Route::get('donation-request','MainController@donationRequest');
        Route::post('get-notification','AuthController@getNotificationSettings');
        Route::post('update-notification','AuthController@updateNotificationSettings');

      });
});
