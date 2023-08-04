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

    function add(request $request){
        try{
            $request->validate([
                'env_id' => 'required',
                'url' => 'required',
            ]);

            $environment_foto = EnvironmentFoto::create([
                'env_id' => $request->env_id,
                'url' => $request->url,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($environment_foto, 'Create Data Environment Foto success');
        }catch(ValidationException $error){
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

    function update(request $request){
        try{
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

            $environment_foto->update([
                'env_id' => $request->env_id,
                'url' => $request->url,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($environment_foto, 'Edit Data Environment Foto success');
        }catch(ValidationException $error){
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
}
