<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\PerangkatFoto;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PerangkatFotoController extends Controller
{
    function all(request $request)
    {
        $perangkat_foto = PerangkatFoto::with(['rack', 'perangkatnilai']);
        return ResponseFormatter::success($perangkat_foto->get(), "Get Perangkat Foto Successfully");
    }

    function add(request $request)
    {
         try {
            $request->validate([
                'rack_id' => 'required',
                'perangkat_nilai_id' => 'required',
                'fotoFile' => 'required',
            ]);

            // store foto baru
            $fotoFile = $request->file('fotoFile');
            $fotoPath = $fotoFile->storeAs('public/foto/perangkat', 'perangkat_' . date("Y_m_d_h_m_s", time()) . '.' . $fotoFile->extension());

            $perangkat_foto = PerangkatFoto::create([
                'rack_id' => $request->rack_id,
                'perangkat_nilai_id' => $request->perangkat_nilai_id,
                'url' => $fotoPath,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success(
                $perangkat_foto,
                'Create Data perangkat Foto success'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Create Data perangkat Foto Failed',
                500,
            );
        }
       
    }

    function update(request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
            ]);

            $perangkat_foto = PerangkatFoto::find($request->id);
            if (!$perangkat_foto) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $perangkat_foto->update([
                'rack_id' => $request->rack_id,
                'perangkat_nilai_id' => $request->perangkat_nilai_id,
                'url' => $request->url,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($perangkat_foto->load(['rack', 'perangkatnilai']), "Edit Perangkat Foto Successfully");
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Perangkat Foto Failed',
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

            $perangkat_foto = PerangkatFoto::find($request->id);

            if (!$perangkat_foto) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Something when wrong',
                        'error' => "Data Not Found",
                    ],
                    'Delete Data p$perangkat_foto Failed',
                    404,
                );
            }

            $perangkat_foto->forceDelete();

            return ResponseFormatter::success(
                null,
                'Delete Data p$perangkat_foto Successfully'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Delete Data p$perangkat_foto Failed',
                400,
            );
        }
    }
}
