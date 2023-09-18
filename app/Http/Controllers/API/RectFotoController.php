<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\RectFoto;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RectFotoController extends Controller
{
    function all(request $request)
    {
        $rect_foto = RectFoto::with('rect');
        return ResponseFormatter::success($rect_foto->get(), "Get Rect Foto Successfully");
    }

    function add(request $request)
    {
        try {
            $request->validate([
                'rect_nilai_id' => 'required',
                'fotoFile' => 'required',
            ]);

            // store foto baru
            $fotoFile = $request->file('fotoFile');
            $fotoPath = $fotoFile->storeAs('public/foto/rect', 'rect_' . date("Y_m_d_h_m_s", time()) . '.' . $fotoFile->extension());

            $rect_foto = RectFoto::create([
                'rect_nilai_id' => $request->rect_nilai_id,
                'url' => $fotoPath,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success(
                $rect_foto,
                'Create Data Rect Foto success'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Create Data Rect Foto Failed',
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

            $rect_foto = RectFoto::find($request->id);
            if (!$rect_foto) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            // hapus foto lama
            unlink(public_path(str_replace(config('app.url'), '', $rect_foto->url)));

            // store foto baru
            $fotoFile = $request->file('fotoFile');
            $fotoPath = $fotoFile->storeAs('public/foto/rect', 'rect_' . date("Y_m_d_h_m_s", time()) . '.' . $fotoFile->extension());

            $rect_foto->update([
                'rect_id' => $request->rect_id,
                'url' => $fotoPath,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($rect_foto, 'Edit Data Rect Foto success');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Edit Data Rect Foto Failed',
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

            $rect_foto = RectFoto::find($request->id);

            if (!$rect_foto) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Something when wrong',
                        'error' => "Data Not Found",
                    ],
                    'Delete Data rec$rect_foto Failed',
                    404,
                );
            }

            $rect_foto->forceDelete();

            return ResponseFormatter::success(
                null,
                'Delete Data rec$rect_foto Successfully'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Delete Data rec$rect_foto Failed',
                400,
            );
        }
    }
}
