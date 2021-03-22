<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;


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


Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('resetpass', 'ClientsController@resetpass');

    Route::post('sms/{id}', 'ClientsController@sms');

    Route::post('pushMpesa', 'PaymentsController@pushMpesa');

    Route::post('access/token', 'MpesaController@generateAccessToken');
    Route::post('stk/push', 'MpesaController@customerMpesaSTKPush');
    Route::post('validation', 'MpesaController@mpesaValidation');
    Route::post('transaction/confirmation', 'MpesaController@mpesaConfirmation');
    Route::post('register/url', 'MpesaController@mpesaRegisterUrls');
    Route::post('password', 'MpesaController@lipaNaMpesaPassword');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {

        Route::post('addclient', 'ClientsController@addclient');
        Route::get('/client/edit/{id}', 'ClientsController@getclient');
        Route::put('/client/update/{id}', 'ClientsController@updateclient');
        Route::delete('/client/delete/{id}', 'ClientsController@deleteclient');
        Route::get('allclients', 'ClientsController@allclients');
        Route::post('changepass', 'AuthController@changepass');

        Route::get('remind/{id}', 'ClientsController@remind');

    });
});
