<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\EnvironmentFoto;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EnvironmentFotoController extends Controller
{
    function all(request $request)
    {
        $environment_foto = EnvironmentFoto::with('inverterNilai');
        return ResponseFormatter::success($environment_foto->get(), "Get Environment Foto Successfully");
    }

    function add(request $request)
    {
        try {
            $request->validate([
                'env_id' => 'required',
                'fotoFile' => 'required',
            ]);

            $fotoFile = $request->file('fotoFile');
            $fotoPath = $fotoFile->storeAs('public/foto/environment', 'environment_' . date("Y_m_d_h_m_s", time()) . '.' . $fotoFile->extension());


            $environment_foto = EnvironmentFoto::create([
                'env_id' => $request->env_id,
                'url' => $fotoPath,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($environment_foto, 'Create Data Environment Foto success');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Environment Foto Failed',
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

            $environment_foto = EnvironmentFoto::find($request->id);
            if (!$environment_foto) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            // hapus foto lama
            unlink(public_path(str_replace(config('app.url'), '', $environment_foto->url)));

            // store foto baru
            $fotoFile = $request->file('fotoFile');
            $fotoPath = $fotoFile->storeAs('public/foto/environment', 'environment_' . date("Y_m_d_h_m_s", time()) . '.' . $fotoFile->extension());

            $environment_foto->update([
                'env_id' => $request->env_id,
                'url' => $fotoPath,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($environment_foto, 'Edit Data Environment Foto success');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Environment Foto Failed',
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

            $environment = EnvironmentFoto::find($request->id);

            if (!$environment) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Something when wrong',
                        'error' => "Data Not Found",
                    ],
                    'Delete Data environment Failed',
                    404,
                );
            }

            $environment->forceDelete();

            return ResponseFormatter::success(
                null,
                'Delete Data environment Successfully'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Delete Data environment Failed',
                400,
            );
        }
    }
}
