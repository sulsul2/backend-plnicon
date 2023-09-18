<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\UjiBaterai;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UjiBateraiController extends Controller
{
    function all(request $request)
    {
        $uji_baterai = UjiBaterai::with(['jadwalPm', 'baterai']);
        return ResponseFormatter::success($uji_baterai->get(), "Get Data Uji Baterai Successfully");
    }

    function add(request $request)
    {
        try {
            $request->validate([
                'pm_id' => 'required',
                'baterai_id' => 'required',
                'jenis_uji' => 'required',
            ]);

            $uji_baterai = UjiBaterai::create([
                'pm_id' => $request->pm_id,
                'baterai_id' => $request->baterai_id,
                'jenis_uji' => $request->jenis_uji,
                'interval' => $request->interval,
                't0' => $request->t0,
                't1' => $request->t1,
                't2' => $request->t2,
                't3' => $request->t3,
                't4' => $request->t4,
                't5' => $request->t5,
                't6' => $request->t6,
                't7' => $request->t7,
                't8' => $request->t8,
            ]);
            return ResponseFormatter::success(
                $uji_baterai->load(['jadwalPm', 'baterai']),
                'Create Data Uji Baterai success'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Create Uji Baterai Failed',
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

            $uji_baterai = UjiBaterai::find($request->id);
            if (!$uji_baterai) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $uji_baterai->update([
                'pm_id' => $request->pm_id,
                'baterai_id' => $request->baterai_id,
                'jenis_uji' => $request->jenis_uji,
                'interval' => $request->interval,
                't0' => $request->t0,
                't1' => $request->t1,
                't2' => $request->t2,
                't3' => $request->t3,
                't4' => $request->t4,
                't5' => $request->t5,
                't6' => $request->t6,
                't7' => $request->t7,
                't8' => $request->t8,
            ]);
            return ResponseFormatter::success(
                $uji_baterai->load(['jadwalPm', 'baterai']),
                'Edit Data Uji Baterai success'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Edit Uji Baterai Failed',
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

            $uji_baterai = UjiBaterai::find($request->id);

            if (!$uji_baterai) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Something when wrong',
                        'error' => "Data Not Found",
                    ],
                    'Delete Data u$uji_baterai Failed',
                    404,
                );
            }

            $uji_baterai->forceDelete();

            return ResponseFormatter::success(
                null,
                'Delete Data u$uji_baterai Successfully'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Delete Data u$uji_baterai Failed',
                400,
            );
        }
    }
}
