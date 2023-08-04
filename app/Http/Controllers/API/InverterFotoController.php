<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\InverterFoto;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InverterFotoController extends Controller
{
    function all(request $request)
    {
        $inverter_foto = InverterFoto::with('inverterNilai');
        return ResponseFormatter::success($inverter_foto->get(), "Get Inverter Foto Successfully");
    }

    function add(request $request){
        try{
            $request->validate([
                'inventer_nilai_id' => 'required',
                'url' => 'required',
            ]);

            $inverter_foto = InverterFoto::create([
                'inventer_nilai_id' => $request->inventer_nilai_id,
                'url' => $request->url,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($inverter_foto, 'Create Data Inverter Foto success');
        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Inverter Foto Failed',
                500,
            );
        }
    }

    function update(request $request){
        try{
            $request->validate([
                'id' => 'required'
            ]);

            $inverter_foto = InverterFoto::find($request->id);
            if (!$inverter_foto) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $inverter_foto->update([
                'inventer_nilai_id' => $request->inventer_nilai_id,
                'url' => $request->url,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($inverter_foto, 'Edit Data Inverter Foto success');
        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Inverter Foto Failed',
                500,
            );
        }
    }
}
