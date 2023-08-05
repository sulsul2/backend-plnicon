<?php

use App\Http\Controllers\API\BateraiNilaiController;
use App\Http\Controllers\API\TemuanController;
use App\Http\Controllers\API\DataPopController;
use App\Http\Controllers\API\EnvironmentController;
use App\Http\Controllers\API\EnvironmentFotoController;
use App\Http\Controllers\API\ExAlarmController;
use App\Http\Controllers\API\ExAlarmFotoController;
use App\Http\Controllers\API\InverterController;
use App\Http\Controllers\API\InverterFotoController;
use App\Http\Controllers\API\InverterNilaiController;
use App\Http\Controllers\API\JadwalPmController;
use App\Http\Controllers\API\RectFotoController;
use App\Http\Controllers\API\RectNilaiController;
use App\Http\Controllers\API\UjiBateraiController;
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
    Route::get('pop', [DataPopController::class, "all"]);
    Route::post('pop', [DataPopController::class, "add"]);
    Route::post('edit-pop', [DataPopController::class, "update"]);

    //Jadwal PM
    Route::get('jadwalpm', [JadwalPmController::class, "all"]);
    Route::post('jadwalpm', [JadwalPmController::class, "add"]);
    Route::post('edit-jadwalpm', [JadwalPmController::class, "update"]);

    //Inverter 
    Route::get('inverter', [InverterController::class, "all"]);
    Route::post('inverter', [InverterController::class, "add"]);
    Route::post('edit-inverter', [InverterController::class, "update"]);

    //Inverter Nilai
    Route::get('inverter-nilai', [InverterNilaiController::class, "all"]);
    Route::post('inverter-nilai', [InverterNilaiController::class, "add"]);
    Route::post('edit-inverter-nilai', [InverterNilaiController::class, "update"]);

    //Inverter foto
    Route::get('inverter-foto', [InverterFotoController::class, "all"]);
    Route::post('inverter-foto', [InverterFotoController::class, "add"]);
    Route::post('edit-inverter-foto', [InverterFotoController::class, "update"]);

    //Environment
    Route::get('environment', [EnvironmentController::class, "all"]);
    Route::post('environment', [EnvironmentController::class, "add"]);
    Route::post('edit-environment', [EnvironmentController::class, "update"]);

    //Environment Foto
    Route::get('environment-foto', [EnvironmentFotoController::class, "all"]);
    Route::post('environment-foto', [EnvironmentFotoController::class, "add"]);
    Route::post('edit-environment-foto', [EnvironmentFotoController::class, "update"]);

    //Ex Alarm
    Route::get('ex-alarm', [ExAlarmController::class, "all"]);
    Route::post('ex-alarm', [ExAlarmController::class, "add"]);
    Route::post('edit-ex-alarm', [ExAlarmController::class, "update"]);

    //Ex Alarm Foto
    Route::get('ex-alarm-foto', [ExAlarmFotoController::class, "all"]);
    Route::post('ex-alarm-foto', [ExAlarmFotoController::class, "add"]);
    Route::post('edit-ex-alarm-foto', [ExAlarmFotoController::class, "update"]);

    //Rect Nilai
    Route::get('rect-nilai', [RectNilaiController::class, "all"]);
    Route::post('rect-nilai', [RectNilaiController::class, "add"]);
    Route::post('edit-rect-nilai', [RectNilaiController::class, "update"]);

    //Rect Foto
    Route::get('rect-foto', [RectFotoController::class, "all"]);
    Route::post('rect-foto', [RectFotoController::class, "add"]);
    Route::post('edit-rect-foto', [RectFotoController::class, "update"]);

    //Baterai Nilai
    Route::get('baterai-nilai', [BateraiNilaiController::class, "all"]);
    Route::post('baterai-nilai', [BateraiNilaiController::class, "add"]);
    Route::post('edit-baterai-nilai', [BateraiNilaiController::class, "update"]);

    // Uji Baterai
    Route::get('uji-baterai', [UjiBateraiController::class, "all"]);
    Route::post('uji-baterai', [UjiBateraiController::class, "add"]);
    Route::post('edit-uji-baterai', [UjiBateraiController::class, "update"]);
});
