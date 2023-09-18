<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Baterai;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BateraiController extends Controller
{
    function all(request $request)
    {
        $baterai = Baterai::with('rect');
        return ResponseFormatter::success($baterai->get(), "Get Modul Successfully");
    }

    function add(request $request)
    {
        try {
            $request->validate([
                'rect_id' => 'required',
                'bank_id' => 'required',
                'nama' => 'required',
                'merk' => 'required',
                'tipe' => 'required',
                'sn' => 'required',
                'kapasitas' => 'required',
                'persentase' => 'required',
                'vbatt' => 'required',
                'tgl_uji' => 'required',
                'tgl_instalasi' => 'required',
            ]);

            $baterai = Baterai::create([
                'rect_id' => $request->rect_id,
                'bank_id' => $request->bank_id,
                'nama' => $request->nama,
                'merk' => $request->merk,
                'tipe' => $request->tipe,
                'sn' => $request->sn,
                'kapasitas' => $request->kapasitas,
                'persentase' => $request->persentase,
                'vbatt' => $request->vbatt,
                'tgl_uji' => $request->tgl_uji,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($baterai->load('rect'), "Create Baterai Successfully");
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Baterai Failed',
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

            $baterai = Baterai::find($request->id);
            if (!$baterai) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $baterai->update([
                'rect_id' => $request->rect_id,
                'bank_id' => $request->bank_id,
                'nama' => $request->nama,
                'merk' => $request->merk,
                'tipe' => $request->tipe,
                'sn' => $request->sn,
                'kapasitas' => $request->kapasitas,
                'persentase' => $request->persentase,
                'vbatt' => $request->vbatt,
                'tgl_uji' => $request->tgl_uji,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($baterai->load('rect'), "Edit baterai Successfully");
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Update Baterai Failed',
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

            $baterai = Baterai::find($request->id);

            if (!$baterai) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Something when wrong',
                        'error' => "Data Not Found",
                    ],
                    'Delete Data baterai Failed',
                    404,
                );
            }

            $baterai->forceDelete();

            return ResponseFormatter::success(
                null,
                'Delete Data baterai Successfully'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Delete Data baterai Failed',
                400,
            );
        }
    }
}
