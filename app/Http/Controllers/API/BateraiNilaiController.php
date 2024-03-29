<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\BateraiNilai;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BateraiNilaiController extends Controller
{
    function all(request $request)
    {
        $baterai_nilai = BateraiNilai::with(['jadwalPm', 'baterai']);
        if ($request->pm_id && $request->baterai_id) {
            $baterai_nilai->where('pm_id', $request->pm_id)->where('baterai_id', $request->baterai_id)->first();
            if (!$baterai_nilai) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }
            return ResponseFormatter::success($baterai_nilai->get(), "Get Baterai Nilai Successfully");
        }
        return ResponseFormatter::success($baterai_nilai->get(), "Get Baterai Nilai Successfully");
    }

    function add(request $request)
    {
        try {
            $request->validate([
                'pm_id' => 'required',
                'baterai_id' => 'required',
                'load' => 'required',
                'group_vbank' => 'required',
                'time_discharge' => 'required',
                'stop_uji_baterai' => 'required',
                'performance' => 'required',
                'sisa_kapasitas' => 'required',
                'kemampuan_backup_time' => 'required',
            ]);

            $baterai_nilai = BateraiNilai::create([
                'pm_id' => $request->pm_id,
                'baterai_id' => $request->baterai_id,
                'load' => $request->load,
                'group_vbank' => $request->group_vbank,
                'time_discharge' => $request->time_discharge,
                'stop_uji_baterai' => $request->stop_uji_baterai,
                'performance' => $request->performance,
                'sisa_kapasitas' => $request->sisa_kapasitas,
                'kemampuan_backup_time' => $request->kemampuan_backup_time,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
            ]);
            return ResponseFormatter::success(
                $baterai_nilai->load(['jadwalPm', 'baterai']),
                'Create Data Baterai Nilai success'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Baterai Nilai Failed',
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

            $baterai_nilai = BateraiNilai::find($request->id);
            if (!$baterai_nilai) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $baterai_nilai->update([
                'pm_id' => $request->pm_id,
                'baterai_id' => $request->baterai_id,
                'load' => $request->load,
                'group_vbank' => $request->group_vbank,
                'time_discharge' => $request->time_discharge,
                'stop_uji_baterai' => $request->stop_uji_baterai,
                'performance' => $request->performance,
                'sisa_kapasitas' => $request->sisa_kapasitas,
                'kemampuan_backup_time' => $request->kemampuan_backup_time,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
            ]);
            return ResponseFormatter::success(
                $baterai_nilai->load(['jadwalPm', 'baterai']),
                'Edit Data Baterai Nilai success'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Edit Baterai Nilai Failed',
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

            $baterai = BateraiNilai::find($request->id);

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
