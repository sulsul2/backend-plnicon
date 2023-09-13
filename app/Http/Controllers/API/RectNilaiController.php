<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\RectNilai;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RectNilaiController extends Controller
{
    function all(request $request)
    {
        $rect_nilai = RectNilai::with(['jadwalPm', 'rect']);
        if ($request->pm_id && $request->rect_id) {
            $rect_nilai->where('pm_id', $request->pm_id)->where('rect_id', $request->rect_id)->first();
            if (!$rect_nilai) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }
            return ResponseFormatter::success($rect_nilai->get(), "Get Kwh Nilai Successfully");
        }
        return ResponseFormatter::success($rect_nilai->get(), "Get Nilai Rect Successfully");
    }

    function add(request $request)
    {
        try {
            $request->validate([
                'pm_id' => 'required',
                'rect_id' => 'required',
            ]);

            $rect_nilai = RectNilai::create([
                'pm_id' => $request->pm_id,
                'rect_id' => $request->rect_id,
                'loadr' => $request->loadr,
                'loads' => $request->loads,
                'loadt' => $request->loadt,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
            ]);
            return ResponseFormatter::success(
                $rect_nilai->load(['jadwalPm', 'rect']),
                'Create Nilai Rect success'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Create Nilai Rect Failed',
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

            $rect_nilai = RectNilai::find($request->id);
            if (!$rect_nilai) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $rect_nilai->update([
                'pm_id' => $request->pm_id,
                'rect_id' => $request->rect_id,
                'loadr' => $request->loadr,
                'loads' => $request->loads,
                'loadt' => $request->loadt,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
            ]);
            return ResponseFormatter::success(
                $rect_nilai->load(['jadwalPm', 'rect']),
                'Edit Nilai Rect success'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Edit Nilai Rect Failed',
                500,
            );
        }
    }
}
