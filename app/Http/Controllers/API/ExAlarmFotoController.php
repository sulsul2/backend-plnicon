<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ExAlarmFoto;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ExAlarmFotoController extends Controller
{
    function all(request $request)
    {
        $ex_alarm_foto = ExAlarmFoto::with('exAlarm');
        return ResponseFormatter::success($ex_alarm_foto->get(), "Get Ex Alarm Foto Successfully");
    }

    function add(request $request){
        try{
            $request->validate([
                'ex_alarm_id' => 'required',
                'url' => 'required',
            ]);

            $ex_alarm_foto = ExAlarmFoto::create([
                'ex_alarm_id' => $request->ex_alarm_id,
                'url' => $request->url,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($ex_alarm_foto, 'Create Data Ex Alarm Foto success');
        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Ex Alarm Foto Failed',
                500,
            );
        }
    }

    function update(request $request){
        try{
            $request->validate([
                'id' => 'required'
            ]);

            $ex_alarm_foto = ExAlarmFoto::find($request->id);
            if (!$ex_alarm_foto) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $ex_alarm_foto->update([
                'ex_alarm_id' => $request->ex_alarm_id,
                'url' => $request->url,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($ex_alarm_foto, 'Edit Data Ex Alarm Foto success');
        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Ex Alarm Foto Failed',
                500,
            );
        }
    }
}
