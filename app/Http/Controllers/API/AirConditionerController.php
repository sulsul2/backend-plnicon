<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\AirConditioner;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AirConditionerController extends Controller
{
    function all(request $request)
    {
        $air_conditioner = AirConditioner::with('dataPop');
        return ResponseFormatter::success($air_conditioner->get(), "Get AirConditioner Successfully");
    }

    function add(request $request){
        try{
            $request->validate([
                'pop_id' => 'required',
                'nama' => 'required',
                'kondisi' => 'required',
                'merk' => 'required',
                'kapasitas' => 'required',
                'tekanan_freon' => 'required',
                'mode_hidup' => 'required',
                'tgl_instalasi' => 'required',
            ]);

            $air_conditioner = AirConditioner::create([
                'pop_id' => $request->pop_id,
                'nama' => $request->nama,
                'kondisi' => $request->kondisi,
                'merk' => $request->merk,
                'kapasitas' => $request->kapasitas,
                'tekanan_freon' => $request->tekanan_freon,
                'mode_hidup' => $request->mode_hidup,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($air_conditioner, 'Create Data AirConditioner success');
        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add AirConditioner Failed',
                500,
            );
        }
    }

    function update(request $request){
        try{
            $request->validate([
                'id' => 'required'
            ]);

            $air_conditioner = AirConditioner::find($request->id);
            if (!$air_conditioner) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $air_conditioner->update([
                'pop_id' => $request->pop_id,
                'nama' => $request->nama,
                'kondisi' => $request->kondisi,
                'merk' => $request->merk,
                'kapasitas' => $request->kapasitas,
                'tekanan_freon' => $request->tekanan_freon,
                'mode_hidup' => $request->mode_hidup,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($air_conditioner, 'Edit Data AirConditioner success');
        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add AirConditioner Failed',
                500,
            );
        }
    }
}