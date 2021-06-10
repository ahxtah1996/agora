<?php

use Illuminate\Support\Facades\Route;

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
});

// Test agora
Route::group(['middleware' => ['auth']], function () {
    Route::get('/agora-chat', 'AgoraVideoController@index');
    Route::post('/agora/token', 'AgoraVideoController@token');
    Route::post('/agora/call-user', 'AgoraVideoController@callUser');
});

// Test stripe
Route::get('/payment', ['as'=>'home','uses'=>'SubscriptionController@index'])->name('subscription.create');
Route::post('order-post', ['as'=>'order-post','uses'=>'SubscriptionController@orderPost']);

Route::get('stripe', 'StripeController@stripe');
Route::post('stripe', 'StripeController@stripePost')->name('stripe.post');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('chat', 'ChatController@store')->name('chat.store');
Route::post('chat/join', 'ChatController@join')->name('chat.join');
