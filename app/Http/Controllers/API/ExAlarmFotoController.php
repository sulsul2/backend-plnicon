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

    function add(request $request)
    {
        try {
            $request->validate([
                'ex_alarm_id' => 'required',
                'fotoFile' => 'required',
            ]);

            $fotoFile = $request->file('fotoFile');
            $fotoPath = $fotoFile->storeAs('public/foto/exalarm', 'exalarm_' . date("Y_m_d_h_m_s", time()) . '.' . $fotoFile->extension());

            $ex_alarm_foto = ExAlarmFoto::create([
                'ex_alarm_id' => $request->ex_alarm_id,
                'url' => $fotoPath,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($ex_alarm_foto, 'Create Data Ex Alarm Foto success');
        } catch (ValidationException $error) {
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

    function update(request $request)
    {
        try {
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

            // hapus foto lama
            unlink(public_path(str_replace(config('app.url'), '', $ex_alarm_foto->url)));

            // store foto baru
            $fotoFile = $request->file('fotoFile');
            $fotoPath = $fotoFile->storeAs('public/foto/exalarm', 'exalarm_' . date("Y_m_d_h_m_s", time()) . '.' . $fotoFile->extension());

            $ex_alarm_foto->update([
                'ex_alarm_id' => $request->ex_alarm_id,
                'url' => $fotoPath,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($ex_alarm_foto, 'Edit Data Ex Alarm Foto success');
        } catch (ValidationException $error) {
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

    function delete(request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
            ]);

            $ex_alarm = ExAlarmFoto::find($request->id);

            if (!$ex_alarm) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Something when wrong',
                        'error' => "Data Not Found",
                    ],
                    'Delete Data ex_alarm Failed',
                    404,
                );
            }

            $ex_alarm->forceDelete();

            return ResponseFormatter::success(
                null,
                'Delete Data ex_alarm Successfully'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Delete Data ex_alarm Failed',
                400,
            );
        }
    }
}
