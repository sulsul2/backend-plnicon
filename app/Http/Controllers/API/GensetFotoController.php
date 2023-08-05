<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\GensetFoto;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GensetFotoController extends Controller
{
    function all(request $request)
    {
        $genset_foto = GensetFoto::with('gensetNilai');
        return ResponseFormatter::success($genset_foto->get(), "Get Genset Foto Successfully");
    }

    function add(request $request){
        try{
            $request->validate([
                'genset_nilai_id' => 'required',
                'fotoFile' => 'required',
            ]);

            $fotoFile = $request->file('fotoFile');
            $fotoPath = $fotoFile->storeAs('public/foto/genset', 'genset_' . date("Y_m_d_h_m_s", time()) . '.' . $fotoFile->extension());

            $genset_foto = GensetFoto::create([
                'genset_nilai_id' => $request->genset_nilai_id,
                'url' => $fotoPath,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($genset_foto, 'Create Data Genset Foto success');
        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Genset Foto Failed',
                500,
            );
        }
    }

    function update(request $request){
        try{
            $request->validate([
                'id' => 'required'
            ]);

            $genset_foto = GensetFoto::find($request->id);
            if (!$genset_foto) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            // hapus foto lama
            unlink(public_path(str_replace(config('app.url'), '', $genset_foto->url)));

            // store foto baru
            $fotoFile = $request->file('fotoFile');
            $fotoPath = $fotoFile->storeAs('public/foto/genset', 'genset_' . date("Y_m_d_h_m_s", time()) . '.' . $fotoFile->extension());

            $genset_foto->update([
                'genset_nilai_id' => $request->genset_nilai_id,
                'url' => $fotoPath,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($genset_foto, 'Edit Data Genset Foto success');
        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Genset Foto Failed',
                500,
            );
        }
    }
}