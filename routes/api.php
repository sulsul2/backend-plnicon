<?php

use App\Http\Controllers\API\DataPopController;
use App\Http\Controllers\API\UserController;
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

// USER
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    // USER
    Route::get('user', [UserController::class, 'get']);
    Route::post('logout', [UserController::class, 'logout']);
});

//Data Pop
Route::get('pop', [DataPopController::class,"all"]);
Route::post('pop', [DataPopController::class,"add"]);
Route::post('editpop', [DataPopController::class,"update"]);
