<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\PdbFoto;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PdbFotoController extends Controller
{
    function all(request $request)
    {
        $pdb_foto = PdbFoto::with('pdbNilai');
        return ResponseFormatter::success($pdb_foto->get(), "Get Pdb Foto Successfully");
    }

    function add(request $request)
    {
        try {
            $request->validate([
                'pdb_nilai_id' => 'required',
                'fotoFile' => 'required',
            ]);

            // store foto baru
            $fotoFile = $request->file('fotoFile');
            $fotoPath = $fotoFile->storeAs('public/foto/pdb', 'pdb_' . date("Y_m_d_h_m_s", time()) . '.' . $fotoFile->extension());

            $pdb_foto = PdbFoto::create([
                'pdb_nilai_id' => $request->pdb_nilai_id,
                'url' => $fotoPath,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success(
                $pdb_foto,
                'Create Data Pdb Foto success'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Create Data Pdb Foto Failed',
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

            $pdb_foto = PdbFoto::find($request->id);
            if (!$pdb_foto) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            // hapus foto lama
            unlink(public_path(str_replace(config('app.url'), '', $pdb_foto->url)));

            // store foto baru
            $fotoFile = $request->file('fotoFile');
            $fotoPath = $fotoFile->storeAs('public/foto/pdb', 'pdb_' . date("Y_m_d_h_m_s", time()) . '.' . $fotoFile->extension());

            $pdb_foto->update([
                'pdb_nilai_id' => $request->pdb_nilai_id,
                'url' => $fotoPath,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($pdb_foto, 'Edit Data Pdb Foto success');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Edit Data Pdb Foto Failed',
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

            $pdb_foto = PdbFoto::find($request->id);

            if (!$pdb_foto) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Something when wrong',
                        'error' => "Data Not Found",
                    ],
                    'Delete Data pd$pdb_foto Failed',
                    404,
                );
            }

            $pdb_foto->forceDelete();

            return ResponseFormatter::success(
                null,
                'Delete Data pd$pdb_foto Successfully'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Delete Data pd$pdb_foto Failed',
                400,
            );
        }
    }
}
