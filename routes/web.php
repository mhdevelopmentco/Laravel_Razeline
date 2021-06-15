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

use Illuminate\Support\Facades\Mail;

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/find', 'HomeController@findCreators');
Route::get('/terms', 'HomeController@terms');
Route::get('/privacy', 'HomeController@privacy');

Route::post('/google-sign', 'HomeController@googleSign');
Route::post('/facebook-sign', 'HomeController@facebookSign');
Route::post('/social-sign', 'HomeController@socialSign')->name('socialSign');
Route::post('/register-social-submit', 'HomeController@registerSocialSubmit');
Route::get('/activate_user', 'HomeController@activateUser');

Route::get('/username/{slug}', 'HomeController@profile');

Route::get('/test', function() {
    $user = Auth::user();
    $mi = $user->id;
    return $user;
});

Route::get('/mail', function() {
    $user = \App\User::find(11);

    $act_link=url('/activate_user?user='.base64_encode($user->id));

    $messagesignup = new \App\Mail\MessageSignup($user['name'], $user['email'], $act_link);

    Mail::to($user)->queue($messagesignup);

    //Mail::to($user)->send($mail);
    return $messagesignup;
});
Auth::routes();
Route::get('/messages', 'HomeController@showMessages');
Route::post('/messages/{id}/send', 'HomeController@sendMessage');

Route::get('/profile/{slug?}', 'HomeController@profile')->name('profile');
Route::post('/profile', 'HomeController@updateProfile');
Route::get('/settings', 'HomeController@settings');

Route::get('/payment/confirm', 'HomeController@paymentConfirm');
Route::get('/payment/cancel', 'HomeController@paymentCancel');
Route::get('/payment/test', 'HomeController@testPayment');

Route::get('/subscribe/confirm', 'HomeController@confirmSubscription');
Route::get('/subscribe/cancel', 'HomeController@cancelSubscription');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');