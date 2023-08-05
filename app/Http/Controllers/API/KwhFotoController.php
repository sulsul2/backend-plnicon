<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\KwhFoto;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KwhFotoController extends Controller
{
    function all(request $request){
        $kwh_foto = KwhFoto::with('kwhnilai');
        return ResponseFormatter::success($kwh_foto->get(), "Get Kwh Foto Successfully");
    }

    function add(request $request){
        try {
            $request->validate([
                'kwh_nilai_id' => 'required',
                'url' => 'required',
            ]);

            $kwh_foto = KwhFoto::create([
                'kwh_nilai_id' => $request->kwh_nilai_id,
                'url' => $request->url,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($kwh_foto->load('kwhnilai'), "Create Kwh Foto Successfully");

        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add kwh nilai Nilai Failed',
                500,
            );
        }
    }

    function update(request $request){
        try {
            $request->validate([
                'id' => 'required',
            ]);

            $kwh_foto = KwhFoto::find($request->id);
            if(!$kwh_foto){
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $kwh_foto->update([
                'kwh_nilai_id' => $request->kwh_nilai_id,
                'url' => $request->url,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($kwh_foto->load('kwhnilai'), "Edit kwh foto nilai Successfully");

        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add kwh foto nilai Failed',
                500,
            );
        }
    }
}
