<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\AirConditionerFoto;
use App\Models\AirConditionerNilai;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AirConditionerFotoController extends Controller
{
    function all(request $request)
    {
        $ac_foto = AirConditionerFoto::with('airConditionerNilai');
        return ResponseFormatter::success($ac_foto->get(), "Get Air Conditioner Foto Successfully");
    }

    function add(request $request)
    {
        try {
            $request->validate([
                'ac_nilai_id' => 'required',
                'fotoFile' => 'required',
            ]);

            // store foto baru
            $fotoFile = $request->file('fotoFile');
            $fotoPath = $fotoFile->storeAs('public/foto/ac', 'ac_' . date("Y_m_d_h_m_s", time()) . '.' . $fotoFile->extension());

            $ac_foto = AirConditionerFoto::create([
                'ac_nilai_id' => $request->ac_nilai_id,
                'url' => $fotoPath,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success(
                $ac_foto,
                'Create Data Air Conditioner Foto success'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Create Data Air Conditioner Foto Failed',
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

            $ac_foto = AirConditionerFoto::find($request->id);
            if (!$ac_foto) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            // hapus foto lama
            unlink(public_path(str_replace(config('app.url'), '', $ac_foto->url)));

            // store foto baru
            $fotoFile = $request->file('fotoFile');
            $fotoPath = $fotoFile->storeAs('public/foto/ac', 'ac_' . date("Y_m_d_h_m_s", time()) . '.' . $fotoFile->extension());

            $ac_foto->update([
                'ac_nilai_id' => $request->ac_nilai_id,
                'url' => $fotoPath,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($ac_foto, 'Edit Data Air Conditioner Foto success');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Edit Data Air Conditioner Foto Failed',
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

            $ac = AirConditionerNilai::find($request->id);

            if (!$ac) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Something when wrong',
                        'error' => "Data Not Found",
                    ],
                    'Delete Data ac Failed',
                    404,
                );
            }

            $ac->forceDelete();

            return ResponseFormatter::success(
                null,
                'Delete Data ac Successfully'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Delete Data ac Failed',
                400,
            );
        }
    }
}
