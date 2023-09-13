<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\PdbNilai;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PdbNilaiController extends Controller
{
    function all(request $request)
    {
        $pdb_nilai = PdbNilai::with(['jadwalPm', 'pdb']);
        if ($request->pm_id && $request->pdb_id) {
            $pdb_nilai->where('pm_id', $request->pm_id)->where('pdb_id', $request->pdb_id)->first();
            if (!$pdb_nilai) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }
            return ResponseFormatter::success($pdb_nilai->get(), "Get Pdb Nilai Successfully");
        }
        return ResponseFormatter::success($pdb_nilai->get(), "Get Pdb Nilai Successfully");
    }

    function add(request $request)
    {
        try {
            $request->validate([
                'pm_id' => 'required',
                'pdb_id' => 'required',
                'arester_warna' => 'required',
            ]);

            $pdb_nilai = PdbNilai::create([
                'pm_id' => $request->pm_id,
                'pdb_id' => $request->pdb_id,
                'arester_warna' => $request->arester_warna,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
            ]);
            return ResponseFormatter::success($pdb_nilai, 'Create Data Pdb Nilai success');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Pdb Nilai Failed',
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

            $pdb_nilai = PdbNilai::find($request->id);
            if (!$pdb_nilai) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $pdb_nilai->update([
                'pm_id' => $request->pm_id,
                'pdb_id' => $request->pdb_id,
                'arester_warna' => $request->arester_warna,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
            ]);
            return ResponseFormatter::success($pdb_nilai, 'Edit Data Pdb Nilai success');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Pdb Nilai Failed',
                500,
            );
        }
    }
}
