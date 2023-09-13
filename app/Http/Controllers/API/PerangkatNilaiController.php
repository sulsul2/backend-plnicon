<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\PerangkatNilai;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PerangkatNilaiController extends Controller
{
    function all(request $request)
    {
        $perangkat_nilai = PerangkatNilai::with(['jadwalpm', 'dataperangkat']);
        if ($request->pm_id && $request->perangkat_id) {
            $perangkat_nilai->where('pm_id', $request->pm_id)->where('perangkat_id', $request->perangkat_id)->first();
            if (!$perangkat_nilai) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }
            return ResponseFormatter::success($perangkat_nilai->get(), "Get Perangkat Nilai Successfully");
        }
        return ResponseFormatter::success($perangkat_nilai->get(), "Get Perangkat Nilai Successfully");
    }

    function add(request $request)
    {
        try {
            $request->validate([
                'pm_id' => 'required',
                'perangkat_id' => 'required',
                'temuan' => 'required',
                'rekomendasi' => 'required',
            ]);

            $perangkat_nilai = PerangkatNilai::create([
                'pm_id' => $request->pm_id,
                'perangkat_id' => $request->perangkat_id,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
            ]);
            return ResponseFormatter::success($perangkat_nilai->load(['jadwalpm', 'dataperangkat']), "Create Perangkat Nilai Successfully");
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Perangkat Nilai Failed',
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

            $perangkat_nilai = PerangkatNilai::find($request->id);
            if (!$perangkat_nilai) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $perangkat_nilai->update([
                'pm_id' => $request->pm_id,
                'perangkat_id' => $request->perangkat_id,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
            ]);
            return ResponseFormatter::success($perangkat_nilai->load(['jadwalpm', 'dataperangkat']), "Edit Perangkat Nilai Successfully");
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Perangkat Nilai Failed',
                500,
            );
        }
    }
}
