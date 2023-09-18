<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Inverter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InverterController extends Controller
{
    function all(request $request)
    {
        $inverter = Inverter::with('dataPop');
        if ($request->pop_id) {
            $inverter->where('pop_id', $request->pop_id);
            if (!$inverter) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }
            return ResponseFormatter::success($inverter->get(), "Get Inverter by Pop Id Successfully");
        }
        return ResponseFormatter::success($inverter->get(), "Get Inverter Successfully");
    }

    function add(request $request)
    {
        try {
            $request->validate([
                'pop_id' => 'required',
                'sn' => 'required',
                'kondisi' => 'required',
                'merk' => 'required',
                'tipe' => 'required',
                'kapasitas' => 'required',
                'tgl_instalasi' => 'required',
            ]);

            $inverter = Inverter::create([
                'pop_id' => $request->pop_id,
                'sn' => $request->sn,
                'kondisi' => $request->kondisi,
                'merk' => $request->merk,
                'tipe' => $request->tipe,
                'kapasitas' => $request->kapasitas,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($inverter, 'Create Data Inverter success');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Inverter Failed',
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

            $inverter = Inverter::find($request->id);
            if (!$inverter) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $inverter->update([
                'pop_id' => $request->pop_id,
                'sn' => $request->sn,
                'kondisi' => $request->kondisi,
                'merk' => $request->merk,
                'tipe' => $request->tipe,
                'kapasitas' => $request->kapasitas,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($inverter, 'Edit Data Inverter success');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Inverter Failed',
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

            $inverter = Inverter::find($request->id);

            if (!$inverter) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Something when wrong',
                        'error' => "Data Not Found",
                    ],
                    'Delete Data inverter Failed',
                    404,
                );
            }

            $inverter->forceDelete();

            return ResponseFormatter::success(
                null,
                'Delete Data inverter Successfully'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Delete Data inverter Failed',
                400,
            );
        }
    }
}
