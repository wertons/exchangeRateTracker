<?php

use App\Http\Controllers\CurrencyRatesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('/isCurrencyValid/{currency}',function($currency){
    return CurrencyRatesController::isCurrencyNameValid($currency);
});
Route::get('/snapshot/{currency}',function($currency){
    return CurrencyRatesController::getRates($currency);
});
Route::get('/validCurrencies',function(){
    return CurrencyRatesController::getValidCurrencies();
});
