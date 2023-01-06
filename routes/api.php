<?php

use App\Http\Controllers\Api\OrderController as ApiOrderController;
use App\Http\Controllers\OrderController;
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

Route::prefix('v1')->group(function(){

    Route::prefix('order')->group(function(){
        Route::post('/place', [OrderController::class, 'store']);
    });

    Route::resource('orders', ApiOrderController::class);
    Route::get('orders/{order}/retry', [ApiOrderController::class, 'retry']);


});
