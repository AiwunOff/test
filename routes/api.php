<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleApiController;



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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//si champ api_token dans table users
// Route::middleware('auth:api')->group(function () {

// });


Route::middleware('auth:api')->group(function () {
    // Route::get('users/formations/{user}', 'App\Http\Controllers\UserController@formations');
    // Route::apiResource('usersss', UserController::class);
    
});

