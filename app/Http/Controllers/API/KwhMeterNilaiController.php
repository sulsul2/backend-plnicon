<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\KwhMeterNilai;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KwhMeterNilaiController extends Controller
{
    function all(request $request)
    {
        $kwh_meter_nilai = KwhMeterNilai::with(['kwhmeter', 'jadwalpm']);
        if ($request->pm_id && $request->kwh_id) {
            $kwh_meter_nilai->where('pm_id', $request->pm_id)->where('kwh_id', $request->kwh_id)->first();
            if (!$kwh_meter_nilai) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }
            return ResponseFormatter::success($kwh_meter_nilai->get(), "Get Kwh Nilai Successfully");
        }
        return ResponseFormatter::success($kwh_meter_nilai->get(), "Get Kwh Meter Successfully");
    }

    function add(request $request)
    {
        try {
            $request->validate([
                'kwh_id' => 'required',
                'pm_id' => 'required',
            ]);

            $kwh_meter_nilai = KwhMeterNilai::create([
                'kwh_id' => $request->kwh_id,
                'pm_id' => $request->pm_id,
                'load_r' => $request->load_r,
                'load_s' => $request->load_s,
                'load_t' => $request->load_t,
                'vrn' => $request->vrn,
                'vsn' => $request->vsn,
                'vtn' => $request->vtn,
                'vng' => $request->vng,
                'vrs' => $request->vrs,
                'vrt' => $request->vrt,
                'vst' => $request->vst,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
            ]);
            return ResponseFormatter::success($kwh_meter_nilai->load(['kwhmeter', 'jadwalpm']), "Create Kwh Meter Nilai Successfully");
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add kwh Meter Nilai Failed',
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

            $kwh_meter_nilai = KwhMeterNilai::find($request->id);
            if (!$kwh_meter_nilai) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $kwh_meter_nilai->update([
                'kwh_id' => $request->kwh_id,
                'pm_id' => $request->pm_id,
                'load_r' => $request->load_r,
                'load_s' => $request->load_s,
                'load_t' => $request->load_t,
                'vrn' => $request->vrn,
                'vsn' => $request->vsn,
                'vtn' => $request->vtn,
                'vng' => $request->vng,
                'vrs' => $request->vrs,
                'vrt' => $request->vrt,
                'vst' => $request->vst,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
            ]);
            return ResponseFormatter::success($kwh_meter_nilai->load(['kwhmeter', 'jadwalpm']), "Edit kwh meter nilai Successfully");
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add kwh meter nilai Failed',
                500,
            );
        }
    }
}
