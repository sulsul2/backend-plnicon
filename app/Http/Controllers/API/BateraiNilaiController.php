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
            return ResponseFormatter::success($baterai_nilai, "Get Baterai Nilai Successfully");
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
                'cell_v1' => 'required',
                'cell_v2' => 'required',
                'cell_v3' => 'required',
                'cell_v4' => 'required',
                'time_discharge' => 'required',
                'stop_uji_baterai' => 'required',
                'performance' => 'required',
                'sisa_kapasitas' => 'required',
                'kemampuan_backup_time' => 'required',
                'jumlah_baterai_rusak' => 'required',
            ]);

            $baterai_nilai = BateraiNilai::create([
                'pm_id' => $request->pm_id,
                'baterai_id' => $request->baterai_id,
                'load' => $request->load,
                'group_vbank' => $request->group_vbank,
                'cell_v1' => $request->cell_v1,
                'cell_v2' => $request->cell_v2,
                'cell_v3' => $request->cell_v3,
                'cell_v4' => $request->cell_v4,
                'time_discharge' => $request->time_discharge,
                'stop_uji_baterai' => $request->stop_uji_baterai,
                'performance' => $request->performance,
                'sisa_kapasitas' => $request->sisa_kapasitas,
                'kemampuan_backup_time' => $request->kemampuan_backup_time,
                'jumlah_baterai_rusak' => $request->jumlah_baterai_rusak,
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
                'cell_v1' => $request->cell_v1,
                'cell_v2' => $request->cell_v2,
                'cell_v3' => $request->cell_v3,
                'cell_v4' => $request->cell_v4,
                'time_discharge' => $request->time_discharge,
                'stop_uji_baterai' => $request->stop_uji_baterai,
                'performance' => $request->performance,
                'sisa_kapasitas' => $request->sisa_kapasitas,
                'kemampuan_backup_time' => $request->kemampuan_backup_time,
                'jumlah_baterai_rusak' => $request->jumlah_baterai_rusak,
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
}
