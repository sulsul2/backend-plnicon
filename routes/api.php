<?php

use App\Http\Controllers\API\BateraiController;
use App\Http\Controllers\API\TemuanController;
use App\Http\Controllers\API\DataPopController;
use App\Http\Controllers\API\DataRackController;
use App\Http\Controllers\API\EnvironmentController;
use App\Http\Controllers\API\EnvironmentFotoController;
use App\Http\Controllers\API\ExAlarmController;
use App\Http\Controllers\API\ExAlarmFotoController;
use App\Http\Controllers\API\InverterController;
use App\Http\Controllers\API\InverterFotoController;
use App\Http\Controllers\API\InverterNilaiController;
use App\Http\Controllers\API\JadwalPmController;
use App\Http\Controllers\API\ModulController;
use App\Http\Controllers\API\NotifikasiController;
use App\Http\Controllers\API\RectController;
use App\Http\Controllers\API\UserController;
use App\Models\DataPerangkat;
use App\Models\PerangkatFoto;
use App\Models\PerangkatNilai;
use App\Models\Port;
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
    Route::post('edit-pop', [DataPopController::class,"update"]);
    
    //Jadwal PM
    Route::get('jadwalpm', [JadwalPmController::class,"all"]);
    Route::post('jadwalpm', [JadwalPmController::class,"add"]);
    Route::post('edit-jadwalpm', [JadwalPmController::class,"update"]);
    
    //Inverter 
    Route::get('inverter', [InverterController::class,"all"]);
    Route::post('inverter', [InverterController::class,"add"]);
    Route::post('edit-inverter', [InverterController::class,"update"]);
    
    //Inverter Nilai
    Route::get('inverter-nilai', [InverterNilaiController::class,"all"]);
    Route::post('inverter-nilai', [InverterNilaiController::class,"add"]);
    Route::post('edit-inverter-nilai', [InverterNilaiController::class,"update"]);
    
    //Inverter foto
    Route::get('inverter-foto', [InverterFotoController::class,"all"]);
    Route::post('inverter-foto', [InverterFotoController::class,"add"]);
    Route::post('edit-inverter-foto', [InverterFotoController::class,"update"]);

    //Environment
    Route::get('environment', [EnvironmentController::class,"all"]);
    Route::post('environment', [EnvironmentController::class,"add"]);
    Route::post('edit-environment', [EnvironmentController::class,"update"]);
    
    //Environment Foto
    Route::get('environment-foto', [EnvironmentFotoController::class,"all"]);
    Route::post('environment-foto', [EnvironmentFotoController::class,"add"]);
    Route::post('edit-environment-foto', [EnvironmentFotoController::class,"update"]);
    
    //Ex Alarm
    Route::get('ex-alarm', [ExAlarmController::class,"all"]);
    Route::post('ex-alarm', [ExAlarmController::class,"add"]);
    Route::post('edit-ex-alarm', [ExAlarmController::class,"update"]);
    
    //Ex Alarm Foto
    Route::get('ex-alarm-foto', [ExAlarmFotoController::class,"all"]);
    Route::post('ex-alarm-foto', [ExAlarmFotoController::class,"add"]);
    Route::post('edit-ex-alarm-foto', [ExAlarmFotoController::class,"update"]);

    //Ex Alarm Foto
    Route::get('ex-alarm-foto', [ExAlarmFotoController::class,"all"]);
    Route::post('ex-alarm-foto', [ExAlarmFotoController::class,"add"]);
    Route::post('edit-ex-alarm-foto', [ExAlarmFotoController::class,"update"]);

    //Rect
    Route::get('rect', [RectController::class,"all"]);
    Route::post('rect', [RectController::class,"add"]);
    Route::post('rect', [RectController::class,"update"]);

    //Modul
    Route::get('modul', [ModulController::class,"all"]);
    Route::post('modul', [ModulController::class,"add"]);
    Route::post('modul', [ModulController::class,"update"]);

    //Baterai
    Route::get('baterai', [BateraiController::class,"all"]);
    Route::post('baterai', [BateraiController::class,"add"]);
    Route::post('baterai', [BateraiController::class,"update"]);

    //Notifikasi
    Route::get('notifikasi', [NotifikasiController::class,"all"]);
    Route::post('notifikasi', [NotifikasiController::class,"add"]);
    Route::post('notifikasi', [NotifikasiController::class,"update"]);

    //Data Rack
    Route::get('data_rack', [DataRackController::class,"all"]);
    Route::post('data_rack', [DataRackController::class,"add"]);
    Route::post('data_rack', [DataRackController::class,"update"]);

    //Data Perangkat
    Route::get('data_perangkat', [DataPerangkat::class,"all"]);
    Route::post('data_perangkat', [DataPerangkat::class,"add"]);
    Route::post('data_perangkat', [DataPerangkat::class,"update"]);

    //Perangkat Nilai
    Route::get('perangkat_nilai', [PerangkatNilai::class,"all"]);
    Route::post('perangkat_nilai', [PerangkatNilai::class,"add"]);
    Route::post('perangkat_nilai', [PerangkatNilai::class,"update"]);

    //Perangkat Foto
    Route::get('perangkat_foto', [PerangkatFoto::class,"all"]);
    Route::post('perangkat_foto', [PerangkatFoto::class,"add"]);
    Route::post('perangkat_foto', [PerangkatFoto::class,"update"]);

    //Port
    Route::get('port', [Port::class,"all"]);
    Route::post('port', [Port::class,"add"]);
    Route::post('port', [Port::class,"update"]);
});
