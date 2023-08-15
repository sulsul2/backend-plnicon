<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\AirConditionerNilai;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AirConditionerNilaiController extends Controller
{
    function all(request $request)
    {
        $ac_nilai = AirConditionerNilai::with(['jadwalPm','airConditioner','foto']);
        return ResponseFormatter::success($ac_nilai->get(), "Get Air Conditioner Nilai Successfully");
    }

    function add(request $request){
        try{
            $request->validate([
                'pm_id' => 'required',
                'ac_id' => 'required',
                'suhu_ac' => 'required',
                'hasil_pengujian' => 'required',
            ]);

            $ac_nilai = AirConditionerNilai::create([
                'pm_id' => $request->pm_id,
                'ac_id' => $request->ac_id,
                'suhu_ac' => $request->suhu_ac,
                'hasil_pengujian' => $request->hasil_pengujian,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
            ]);
            return ResponseFormatter::success($ac_nilai, 'Create Data Air Conditioner Nilai success');
        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Air Conditioner Nilai Failed',
                500,
            );
        }
    }

    function update(request $request){
        try{
            $request->validate([
                'id' => 'required'
            ]);

            $ac_nilai = AirConditionerNilai::find($request->id);
            if (!$ac_nilai) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $ac_nilai->update([
                'pm_id' => $request->pm_id,
                'ac_id' => $request->ac_id,
                'suhu_ac' => $request->suhu_ac,
                'hasil_pengujian' => $request->hasil_pengujian,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
            ]);
            return ResponseFormatter::success($ac_nilai, 'Edit Data Air Conditioner Nilai success');
        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Air Conditioner Nilai Failed',
                500,
            );
        }
    }
}
