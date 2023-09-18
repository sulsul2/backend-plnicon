<?php

use App\Http\Controllers\API\AirConditionerController;
use App\Http\Controllers\API\AirConditionerFotoController;
use App\Http\Controllers\API\AirConditionerNilaiController;
use App\Http\Controllers\API\BateraiNilaiController;
use App\Http\Controllers\API\BateraiController;
use App\Http\Controllers\API\DataPerangkatController;
use App\Http\Controllers\API\TemuanController;
use App\Http\Controllers\API\DataPopController;
use App\Http\Controllers\API\DataRackController;
use App\Http\Controllers\API\EnvironmentController;
use App\Http\Controllers\API\EnvironmentFotoController;
use App\Http\Controllers\API\ExAlarmController;
use App\Http\Controllers\API\ExAlarmFotoController;
use App\Http\Controllers\API\GensetController;
use App\Http\Controllers\API\GensetFotoController;
use App\Http\Controllers\API\GensetNilaiController;
use App\Http\Controllers\API\InverterController;
use App\Http\Controllers\API\InverterFotoController;
use App\Http\Controllers\API\InverterNilaiController;
use App\Http\Controllers\API\JadwalPmController;
use App\Http\Controllers\API\KwhFotoController;
use App\Http\Controllers\API\KwhMeterController;
use App\Http\Controllers\API\KwhMeterNilaiController;
use App\Http\Controllers\API\McbController;
use App\Http\Controllers\API\RectFotoController;
use App\Http\Controllers\API\RectNilaiController;
use App\Http\Controllers\API\UjiBateraiController;
use App\Http\Controllers\API\ModulController;
use App\Http\Controllers\API\NotifikasiController;
use App\Http\Controllers\API\PdbController;
use App\Http\Controllers\API\PdbFotoController;
use App\Http\Controllers\API\PdbNilaiController;
use App\Http\Controllers\API\PerangkatFotoController;
use App\Http\Controllers\API\PerangkatNilaiController;
use App\Http\Controllers\API\PortController;
use App\Http\Controllers\API\RectController;
use App\Http\Controllers\API\UserController;
use App\Models\AirConditionerNilai;
use App\Models\DataPerangkat;
use App\Models\KwhMeter;
use App\Models\KwhMeterNilai;
use App\Models\Pdb;
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
    Route::get('all-user', [UserController::class, 'all']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::post('delete-user', [UserController::class, 'delete']);

    // Temuan
    Route::get('temuan', [TemuanController::class, 'all']);
    Route::post('temuan', [TemuanController::class, 'add']);
    Route::post('edit-temuan', [TemuanController::class, 'update']);
    Route::post('delete-temuan', [TemuanController::class, 'delete']);

    //Data Pop
    Route::get('pop', [DataPopController::class, "all"]);
    Route::post('pop', [DataPopController::class, "add"]);
    Route::post('edit-pop', [DataPopController::class, "update"]);
    Route::post('delete-pop', [DataPopController::class, "delete"]);

    //Jadwal PM
    Route::get('jadwalpm', [JadwalPmController::class, "all"]);
    Route::get('jadwalpm-user', [JadwalPmController::class, "getByUser"]);
    Route::post('jadwalpm', [JadwalPmController::class, "add"]);
    Route::post('edit-jadwalpm', [JadwalPmController::class, "update"]);
    Route::post('delete-jadwalpm', [JadwalPmController::class, "delete"]);

    //Inverter 
    Route::get('inverter', [InverterController::class, "all"]);
    Route::post('inverter', [InverterController::class, "add"]);
    Route::post('edit-inverter', [InverterController::class, "update"]);
    Route::post('delete-inverter', [InverterController::class, "delete"]);

    //Inverter Nilai
    Route::get('inverter-nilai', [InverterNilaiController::class, "all"]);
    Route::post('inverter-nilai', [InverterNilaiController::class, "add"]);
    Route::post('edit-inverter-nilai', [InverterNilaiController::class, "update"]);
    Route::post('delete-inverter-nilai', [InverterNilaiController::class, "delete"]);

    //Inverter foto
    Route::get('inverter-foto', [InverterFotoController::class, "all"]);
    Route::post('inverter-foto', [InverterFotoController::class, "add"]);
    Route::post('edit-inverter-foto', [InverterFotoController::class, "update"]);
    Route::post('delete-inverter-foto', [InverterFotoController::class, "delete"]);

    //Environment
    Route::get('environment', [EnvironmentController::class, "all"]);
    Route::post('environment', [EnvironmentController::class, "add"]);
    Route::post('edit-environment', [EnvironmentController::class, "update"]);
    Route::post('delete-environment', [EnvironmentController::class, "delete"]);

    //Environment Foto
    Route::get('environment-foto', [EnvironmentFotoController::class, "all"]);
    Route::post('environment-foto', [EnvironmentFotoController::class, "add"]);
    Route::post('edit-environment-foto', [EnvironmentFotoController::class, "update"]);
    Route::post('delete-environment-foto', [EnvironmentFotoController::class, "delete"]);

    //Ex Alarm
    Route::get('ex-alarm', [ExAlarmController::class, "all"]);
    Route::post('ex-alarm', [ExAlarmController::class, "add"]);
    Route::post('edit-ex-alarm', [ExAlarmController::class, "update"]);
    Route::post('delete-ex-alarm', [ExAlarmController::class, "delete"]);

    //Ex Alarm Foto
    Route::get('ex-alarm-foto', [ExAlarmFotoController::class, "all"]);
    Route::post('ex-alarm-foto', [ExAlarmFotoController::class, "add"]);
    Route::post('edit-ex-alarm-foto', [ExAlarmFotoController::class, "update"]);
    Route::post('delete-ex-alarm-foto', [ExAlarmFotoController::class, "delete"]);

    //Rect
    Route::get('rect', [RectController::class, "all"]);
    Route::post('rect', [RectController::class, "add"]);
    Route::post('edit-rect', [RectController::class, "update"]);
    Route::post('delete-rect', [RectController::class, "delete"]);

    //Modul
    Route::get('modul', [ModulController::class, "all"]);
    Route::post('modul', [ModulController::class, "add"]);
    Route::post('edit-modul', [ModulController::class, "update"]);
    Route::post('delete-modul', [ModulController::class, "delete"]);

    //Baterai
    Route::get('baterai', [BateraiController::class, "all"]);
    Route::post('baterai', [BateraiController::class, "add"]);
    Route::post('edit-baterai', [BateraiController::class, "update"]);
    Route::post('delete-baterai', [BateraiController::class, "delete"]);

    //Notifikasi
    Route::get('notifikasi', [NotifikasiController::class, "all"]);
    Route::post('notifikasi', [NotifikasiController::class, "add"]);
    Route::post('edit-notifikasi', [NotifikasiController::class, "update"]);
    Route::post('delete-notifikasi', [NotifikasiController::class, "delete"]);

    //Data Rack
    Route::get('data-rack', [DataRackController::class, "all"]);
    Route::post('data-rack', [DataRackController::class, "add"]);
    Route::post('edit-data-rack', [DataRackController::class, "update"]);
    Route::post('delete-data-rack', [DataRackController::class, "delete"]);

    //Data Perangkat
    Route::get('data-perangkat', [DataPerangkatController::class, "all"]);
    Route::post('data-perangkat', [DataPerangkatController::class, "add"]);
    Route::post('edit-data-perangkat', [DataPerangkatController::class, "update"]);
    Route::post('delete-data-perangkat', [DataPerangkatController::class, "delete"]);

    //Perangkat Nilai
    Route::get('perangkat-nilai', [PerangkatNilaiController::class, "all"]);
    Route::post('perangkat-nilai', [PerangkatNilaiController::class, "add"]);
    Route::post('edit-perangkat-nilai', [PerangkatNilaiController::class, "update"]);
    Route::post('delete-perangkat-nilai', [PerangkatNilaiController::class, "delete"]);

    //Perangkat Foto
    Route::get('perangkat-foto', [PerangkatFotoController::class, "all"]);
    Route::post('perangkat-foto', [PerangkatFotoController::class, "add"]);
    Route::post('edit-perangkat-foto', [PerangkatFotoController::class, "update"]);
    Route::post('delete-perangkat-foto', [PerangkatFotoController::class, "delete"]);

    //Port
    Route::get('port', [PortController::class, "all"]);
    Route::post('port', [PortController::class, "add"]);
    Route::post('edit-port', [PortController::class, "update"]);
    Route::post('delete-port', [PortController::class, "delete"]);

    //Rect Nilai
    Route::get('rect-nilai', [RectNilaiController::class, "all"]);
    Route::post('rect-nilai', [RectNilaiController::class, "add"]);
    Route::post('edit-rect-nilai', [RectNilaiController::class, "update"]);
    Route::post('delete-rect-nilai', [RectNilaiController::class, "delete"]);

    //Rect Foto
    Route::get('rect-foto', [RectFotoController::class, "all"]);
    Route::post('rect-foto', [RectFotoController::class, "add"]);
    Route::post('edit-rect-foto', [RectFotoController::class, "update"]);
    Route::post('delete-rect-foto', [RectFotoController::class, "delete"]);

    //Baterai Nilai
    Route::get('baterai-nilai', [BateraiNilaiController::class, "all"]);
    Route::post('baterai-nilai', [BateraiNilaiController::class, "add"]);
    Route::post('edit-baterai-nilai', [BateraiNilaiController::class, "update"]);
    Route::post('delete-baterai-nilai', [BateraiNilaiController::class, "delete"]);

    // Uji Baterai
    Route::get('uji-baterai', [UjiBateraiController::class, "all"]);
    Route::post('uji-baterai', [UjiBateraiController::class, "add"]);
    Route::post('edit-uji-baterai', [UjiBateraiController::class, "update"]);
    Route::post('delete-uji-baterai', [UjiBateraiController::class, "delete"]);

    // Pdb
    Route::get('pdb', [PdbController::class, "all"]);
    Route::post('pdb', [PdbController::class, "add"]);
    Route::post('edit-pdb', [PdbController::class, "update"]);
    Route::post('delete-pdb', [PdbController::class, "delete"]);

    // Pdb Nilai
    Route::get('pdb-nilai', [PdbNilaiController::class, "all"]);
    Route::post('pdb-nilai', [PdbNilaiController::class, "add"]);
    Route::post('edit-pdb-nilai', [PdbNilaiController::class, "update"]);
    Route::post('delete-pdb-nilai', [PdbNilaiController::class, "delete"]);

    // Mcb
    Route::get('mcb', [McbController::class, "all"]);
    Route::post('mcb', [McbController::class, "add"]);
    Route::post('edit-mcb', [McbController::class, "update"]);
    Route::post('delete-mcb', [McbController::class, "delete"]);

    // Pdb Foto
    Route::get('pdb-foto', [PdbFotoController::class, "all"]);
    Route::post('pdb-foto', [PdbFotoController::class, "add"]);
    Route::post('edit-pdb-foto', [PdbFotoController::class, "update"]);
    Route::post('delete-pdb-foto', [PdbFotoController::class, "delete"]);

    // Air Conditioner
    Route::get('air-conditioner', [AirConditionerController::class, "all"]);
    Route::post('air-conditioner', [AirConditionerController::class, "add"]);
    Route::post('edit-air-conditioner', [AirConditionerController::class, "update"]);
    Route::post('delete-air-conditioner', [AirConditionerController::class, "delete"]);

    // Air Conditioner Nilai
    Route::get('air-conditioner-nilai', [AirConditionerNilaiController::class, "all"]);
    Route::post('air-conditioner-nilai', [AirConditionerNilaiController::class, "add"]);
    Route::post('edit-air-conditioner-nilai', [AirConditionerNilaiController::class, "update"]);
    Route::post('delete-air-conditioner-nilai', [AirConditionerNilaiController::class, "delete"]);

    // Air Conditioner Foto
    Route::get('air-conditioner-foto', [AirConditionerFotoController::class, "all"]);
    Route::post('air-conditioner-foto', [AirConditionerFotoController::class, "add"]);
    Route::post('edit-air-conditioner-foto', [AirConditionerFotoController::class, "update"]);
    Route::post('delete-air-conditioner-foto', [AirConditionerFotoController::class, "delete"]);

    // kwh meter
    Route::get('kwh-meter', [KwhMeterController::class, "all"]);
    Route::post('kwh-meter', [KwhMeterController::class, "add"]);
    Route::post('edit-kwh-meter', [KwhMeterController::class, "update"]);
    Route::post('delete-kwh-meter', [KwhMeterController::class, "delete"]);

    // kwh meter nilai
    Route::get('kwh-meter-nilai', [KwhMeterNilaiController::class, "all"]);
    Route::post('kwh-meter-nilai', [KwhMeterNilaiController::class, "add"]);
    Route::post('edit-kwh-meter-nilai', [KwhMeterNilaiController::class, "update"]);
    Route::post('delete-kwh-meter-nilai', [KwhMeterNilaiController::class, "delete"]);

    // kwh meter foto
    Route::get('kwh-foto', [KwhFotoController::class, "all"]);
    Route::post('kwh-foto', [KwhFotoController::class, "add"]);
    Route::post('edit-kwh-foto', [KwhFotoController::class, "update"]);
    Route::post('delete-kwh-foto', [KwhFotoController::class, "delete"]);

    //genset
    Route::get('genset', [GensetController::class, "all"]);
    Route::post('genset', [GensetController::class, "add"]);
    Route::post('edit-genset', [GensetController::class, "update"]);
    Route::post('delete-genset', [GensetController::class, "delete"]);

    //genset nilai
    Route::get('genset-nilai', [GensetNilaiController::class, "all"]);
    Route::post('genset-nilai', [GensetNilaiController::class, "add"]);
    Route::post('edit-genset-nilai', [GensetNilaiController::class, "update"]);
    Route::post('delete-genset-nilai', [GensetNilaiController::class, "delete"]);

    //genset foto
    Route::get('genset-foto', [GensetFotoController::class, "all"]);
    Route::post('genset-foto', [GensetFotoController::class, "add"]);
    Route::post('edit-genset-foto', [GensetFotoController::class, "update"]);
    Route::post('delete-genset-foto', [GensetFotoController::class, "delete"]);
});
