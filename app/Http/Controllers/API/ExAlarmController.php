<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ExAlarm;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ExAlarmController extends Controller
{
    function all(request $request)
    {
        $ex_alarm = ExAlarm::with(['jadwalPm','dataPop','foto']);
        return ResponseFormatter::success($ex_alarm->get(), "Get Ex Alarm Successfully");
    }

    function add(request $request){
        try{
            $request->validate([
                'pm_id' => 'required',
                'pop_id' => 'required',
                'ea' => 'required',
                'suhu' => 'required',
                'pintu' => 'required',
                'pln_off' => 'required',
                'genset_run_fail' => 'required',
                'smokenfire' => 'required',
                'perangkat_ea' => 'required',
                'tgl_instalasi' => 'required',
            ]);

            $ex_alarm = ExAlarm::create([
                'pm_id' => $request->pm_id,
                'pop_id' => $request->pop_id,
                'ea' => $request->ea,
                'suhu' => $request->suhu,
                'pintu' => $request->pintu,
                'pln_off' => $request->pln_off,
                'genset_run_fail' => $request->genset_run_fail,
                'smokenfire' => $request->smokenfire,
                'perangkat_ea' => $request->perangkat_ea,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($ex_alarm, 'Create Data Ex Alarm success');
        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Ex Alarm Failed',
                500,
            );
        }
    }

    function update(request $request){
        try{
            $request->validate([
                'id' => 'required'
            ]);

            $ex_alarm = ExAlarm::find($request->id);
            if (!$ex_alarm) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $ex_alarm->update([
                'pm_id' => $request->pm_id,
                'pop_id' => $request->pop_id,
                'ea' => $request->ea,
                'suhu' => $request->suhu,
                'pintu' => $request->pintu,
                'pln_off' => $request->pln_off,
                'genset_run_fail' => $request->genset_run_fail,
                'smokenfire' => $request->smokenfire,
                'perangkat_ea' => $request->perangkat_ea,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($ex_alarm, 'Edit Data Ex Alarm success');
        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Ex Alarm Failed',
                500,
            );
        }
    }
}
