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

    function add(request $request)
    {
        try {
            $request->validate([
                'inverter_nilai_id' => 'required',
                'fotoFile' => 'required',
            ]);

            $fotoFile = $request->file('fotoFile');
            $fotoPath = $fotoFile->storeAs('public/foto/inverter', 'inverter_' . date("Y_m_d_h_m_s", time()) . '.' . $fotoFile->extension());

            $inverter_foto = InverterFoto::create([
                'inverter_nilai_id' => $request->inverter_nilai_id,
                'url' => $fotoPath,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($inverter_foto, 'Create Data Inverter Foto success');
        } catch (ValidationException $error) {
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

    function update(request $request)
    {
        try {
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

            // hapus foto lama
            unlink(public_path(str_replace(config('app.url'), '', $inverter_foto->url)));

            // store foto baru
            $fotoFile = $request->file('fotoFile');
            $fotoPath = $fotoFile->storeAs('public/foto/inverter', 'inverter_' . date("Y_m_d_h_m_s", time()) . '.' . $fotoFile->extension());

            $inverter_foto->update([
                'inverter_nilai_id' => $request->inverter_nilai_id,
                'url' => $fotoPath,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($inverter_foto, 'Edit Data Inverter Foto success');
        } catch (ValidationException $error) {
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

    function delete(request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
            ]);

            $inverter_foto = InverterFoto::find($request->id);

            if (!$inverter_foto) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Something when wrong',
                        'error' => "Data Not Found",
                    ],
                    'Delete Data inver$inverter_foto Failed',
                    404,
                );
            }

            $inverter_foto->forceDelete();

            return ResponseFormatter::success(
                null,
                'Delete Data inver$inverter_foto Successfully'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Delete Data inver$inverter_foto Failed',
                400,
            );
        }
    }
}
