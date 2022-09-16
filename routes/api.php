<?php

use App\Http\Controllers\Building\BuildingController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\RoomTyping\RoomTypingController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'prefix' => 'customer'
], function(){
    Route::post('/create', [CustomerController::class, 'store']);
});
Route::group([
    'prefix' => 'room-typing'
], function(){
    Route::post('/create', [RoomTypingController::class, 'store']);
});

Route::group([
    'prefix'=>'building'
], function(){
    Route::post('/create', [BuildingController::class, 'store']);
});
