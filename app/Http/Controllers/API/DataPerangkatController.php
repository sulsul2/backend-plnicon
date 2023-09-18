<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\DataPerangkat;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DataPerangkatController extends Controller
{
    function all(request $request)
    {
        $data_perangkat = DataPerangkat::with('datarack');
        return ResponseFormatter::success($data_perangkat->get(), "Get Data Perangkat Successfully");
    }

    function add(request $request)
    {
        try {
            $request->validate([
                'rack_id' => 'required',
                'nama' => 'required',
                'merk' => 'required',
                'sumber_main' => 'required',
                'sumber_backup' => 'required',
                'terminasi' => 'required',
                'jenis' => 'required',
                'tipe' => 'required',
                'tgl_instalasi' => 'tgl_instalasi',
            ]);

            $data_perangkat = DataPerangkat::create([
                'rack_id' => $request->rack_id,
                'nama' => $request->nama,
                'merk' => $request->merk,
                'sumber_main' => $request->sumber_main,
                'sumber_backup' => $request->sumber_backup,
                'terminasi' => $request->terminasi,
                'jenis' => $request->jenis,
                'tipe' => $request->tipe,
                'tgl_instalasi' => $request->tgl_instalasi,

            ]);
            return ResponseFormatter::success($data_perangkat->load('datarack'), "Create Data Perangkat Successfully");
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Data Perangkat Failed',
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

            $data_perangkat = DataPerangkat::find($request->id);
            if (!$data_perangkat) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $data_perangkat->update([
                'rack_id' => $request->rack_id,
                'nama' => $request->nama,
                'merk' => $request->merk,
                'sumber_main' => $request->sumber_main,
                'sumber_backup' => $request->sumber_backup,
                'terminasi' => $request->terminasi,
                'jenis' => $request->jenis,
                'tipe' => $request->tipe,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($data_perangkat->load('datarack'), "Edit Data Perangkat Successfully");
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Data Perangkat Failed',
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

            $perangkat = DataPerangkat::find($request->id);

            if (!$perangkat) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Something when wrong',
                        'error' => "Data Not Found",
                    ],
                    'Delete Data perangkat Failed',
                    404,
                );
            }

            $perangkat->forceDelete();

            return ResponseFormatter::success(
                null,
                'Delete Data perangkat Successfully'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Delete Data perangkat Failed',
                400,
            );
        }
    }
}
