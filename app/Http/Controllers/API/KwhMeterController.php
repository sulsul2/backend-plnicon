<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\KwhMeter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KwhMeterController extends Controller
{
    function all(request $request){
        $kwh_meter = KwhMeter::with('datapop');
        return ResponseFormatter::success($kwh_meter->get(), "Get Kwh Meter Successfully");
    }

    function add(request $request){
        try {
            $request->validate([
                'pop_id' => 'required',
                'jumlah_phasa' => 'required',
                'daya' => 'required',
                'cos' => 'required',
                'arester' => 'required',
                'tgl_instalasi' => 'required',
            ]);

            $kwh_meter = KwhMeter::create([
                'pop_id' => $request->pop_id,
                'jumlah_phasa' => $request->jumlah_phasa,
                'daya' => $request->daya,
                'capmcbr' => $request->capmcbr,
                'capmcbs' => $request->capmcbs,
                'capmcbt' => $request->capmcbt,
                'cos' => $request->cos,
                'cos_type' => $request->cos_type,
                'arester' => $request->arester,
                'arester_type' => $request->arester_type,
                'warna_kabelr' => $request->warna_kabelr,
                'warna_kabels' => $request->warna_kabels,
                'warna_kabelt' => $request->warna_kabelt,
                'warna_kabeln' => $request->warna_kabeln,
                'warna_kabelg' => $request->warna_kabelg,
                'luas_kabelr' => $request->luas_kabelr,
                'luas_kabels' => $request->luas_kabels,
                'luas_kabelt' => $request->luas_kabelt,
                'luas_kabeln' => $request->luas_kabeln,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($kwh_meter->load('datapop'), "Create Kwh Meter Successfully");

        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Jadwal PM Failed',
                500,
            );
        }
    }

    function update(request $request){
        try {
            $request->validate([
                'id' => 'required',
            ]);

            $kwh_meter = KwhMeter::find($request->id);
            if(!$kwh_meter){
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $kwh_meter->update([
                'pop_id' => $request->pop_id,
                'jumlah_phasa' => $request->jumlah_phasa,
                'daya' => $request->daya,
                'capmcbr' => $request->capmcbr,
                'capmcbs' => $request->capmcbs,
                'capmcbt' => $request->capmcbt,
                'cos' => $request->cos,
                'cos_type' => $request->cos_type,
                'arester' => $request->arester,
                'arester_type' => $request->arester_type,
                'warna_kabelr' => $request->warna_kabelr,
                'warna_kabels' => $request->warna_kabels,
                'warna_kabelt' => $request->warna_kabelt,
                'warna_kabeln' => $request->warna_kabeln,
                'warna_kabelg' => $request->warna_kabelg,
                'luas_kabelr' => $request->luas_kabelr,
                'luas_kabels' => $request->luas_kabels,
                'luas_kabelt' => $request->luas_kabelt,
                'luas_kabeln' => $request->luas_kabeln,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($kwh_meter->load('datapop'), "Edit kwh meter Successfully");

        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add kwh meter Failed',
                500,
            );
        }
    }
}
