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

Route::post('login', 'API\UserController@endpointLogin');
Route::post('register', 'API\UserController@endpointRegister');
Route::get('/providers/active-provider', 'API\ProviderController@endpointActiveProvider');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/providers', 'API\ProviderController@endpointGet');
    Route::get('/providers/monthly-payment', 'API\ProviderController@endpointTotalMonthlyPayment');
    Route::post('/providers', 'API\ProviderController@endpointStore');
    Route::delete('/providers/{id}', 'API\ProviderController@endpointDelete');
});
