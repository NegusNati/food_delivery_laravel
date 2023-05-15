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



// The page that displays the payment form
// Route::get('/', function () {
//     return view('welcome');
// });



// The route that the button calls to initialize payment

// Route::post('pay', 'ChapaController@initialize')->name('payment-mobile');

// // The callback url after a payment
// Route::get('callback/{reference}', 'ChapaController@callback')->name('callback');



//dd

// Route::group(['prefix' => 'payment-mobile'], function () {
//     Route::get('/', 'ChapaController@initialize')->name('pay');
//     Route::get('set-payment-method/{name}', 'PaymentController@set_payment_method')->name('set-payment-method');
// });
// Route::post('pay-paypal', 'PaypalPaymentController@payWithpaypal')->name('pay-paypal');
// Route::get('paypal-status', 'PaypalPaymentController@getPaymentStatus')->name('paypal-status');
// Route::get('payment-success', 'PaymentController@success')->name('payment-success');
// Route::get('payment-fail', 'PaymentController@fail')->name('payment-fail');






Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'payment-mobile'], function () {
    Route::get('/', 'ChapaController@initialize')->name('payment-mobile');
    Route::post('pay', 'ChapaController@initialize')->name('payment-mobile');
    Route::get('set-payment-method/{name}', 'PaymentController@set_payment_method')->name('set-payment-method');
});
Route::post('pay-paypal', 'PaypalPaymentController@payWithpaypal')->name('pay-paypal');
Route::get('paypal-status', 'PaypalPaymentController@getPaymentStatus')->name('paypal-status');
Route::get('payment-success', 'PaymentController@success')->name('payment-success');
Route::get('payment-fail', 'PaymentController@fail')->name('payment-fail');
Route::get('callback/{reference}', 'ChapaController@callback')->name('callback');
