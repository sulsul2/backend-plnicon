<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Ats;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AtsController extends Controller
{
    function all(request $request)
    {
        $ats = Ats::with('dataPop');
        return ResponseFormatter::success($ats->get(), "Get Ats Successfully");
    }

    function add(request $request)
    {
        try {
            $request->validate([
                'pop_id' => 'required',
                'tipe' => 'required',
                'sn' => 'required',
                'merk' => 'required',
                'status' => 'required',
                'tgl_instalasi' => 'required',
            ]);

            $ats = Ats::create([
                'pop_id' => $request->pop_id,
                'tipe' => $request->tipe,
                'sn' => $request->sn,
                'merk' => $request->merk,
                'status' => $request->status,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($ats, 'Create Data Ats success');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Ats Failed',
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

            $ats = Ats::find($request->id);
            if (!$ats) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $ats->update([
                'pop_id' => 'required',
                'tipe' => 'required',
                'sn' => 'required',
                'merk' => 'required',
                'status' => 'required',
                'tgl_instalasi' => 'required',
            ]);
            return ResponseFormatter::success($ats, 'Edit Data Ats success');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Ats Failed',
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

            $ats = Ats::find($request->id);

            if (!$ats) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Something when wrong',
                        'error' => "Data Not Found",
                    ],
                    'Delete Data ats Failed',
                    404,
                );
            }

            $ats->forceDelete();

            return ResponseFormatter::success(
                null,
                'Delete Data ats Successfully'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Delete Data ats Failed',
                400,
            );
        }
    }
}
