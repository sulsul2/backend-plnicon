<?php

use App\Http\Controllers\API\TemuanController;
use App\Http\Controllers\API\DataPopController;
use App\Http\Controllers\API\JadwalPmController;
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

    // Temuan
    Route::get('temuan', [TemuanController::class, 'all']);
    Route::post('temuan', [TemuanController::class, 'add']);
    Route::post('edit-temuan', [TemuanController::class, 'update']);
    
    //Data Pop
    Route::get('pop', [DataPopController::class,"all"]);
    Route::post('pop', [DataPopController::class,"add"]);
    Route::post('editpop', [DataPopController::class,"update"]);
    
    //Jadwal PM
    Route::get('jadwalpm', [JadwalPmController::class,"all"]);
    Route::post('jadwalpm', [JadwalPmController::class,"add"]);
    Route::post('editjadwalpm', [JadwalPmController::class,"update"]);
    
});
