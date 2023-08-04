<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\InverterNilai;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InverterNilaiController extends Controller
{
    function all(request $request)
    {
        $inverter_nilai = InverterNilai::with(['jadwalPm','inverter']);
        return ResponseFormatter::success($inverter_nilai->get(), "Get Inverter Nilai Successfully");
    }

    function add(request $request){
        try{
            $request->validate([
                'pm_id' => 'required',
                'inverter_id' => 'required',
                'load' => 'required',
                'input_ac' => 'required',
                'input_dc' => 'required',
                'output_dc' => 'required',
                'mainfall' => 'required',
                'hasil_uji' => 'required',
            ]);

            $inverter_nilai = InverterNilai::create([
                'pm_id' => $request->pm_id,
                'inverter_id' => $request->inverter_id,
                'load' => $request->load,
                'input_ac' => $request->input_ac,
                'input_dc' => $request->input_dc,
                'output_dc' => $request->kapasitas,
                'mainfall' => $request->mainfall,
                'hasil_uji' => $request->hasil_uji,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
            ]);
            return ResponseFormatter::success($inverter_nilai, 'Create Data Inverter Nilai success');
        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Inverter Nilai Failed',
                500,
            );
        }
    }

    function update(request $request){
        try{
            $request->validate([
                'id' => 'required'
            ]);

            $inverter_nilai = InverterNilai::find($request->id);
            if (!$inverter_nilai) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $inverter_nilai->update([
                'pm_id' => $request->pm_id,
                'inverter_id' => $request->inverter_id,
                'load' => $request->load,
                'input_ac' => $request->input_ac,
                'input_dc' => $request->input_dc,
                'output_dc' => $request->kapasitas,
                'mainfall' => $request->mainfall,
                'hasil_uji' => $request->hasil_uji,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
            ]);
            return ResponseFormatter::success($inverter_nilai, 'Edit Data Inverter Nilai success');
        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Inverter Nilai Failed',
                500,
            );
        }
    }
}