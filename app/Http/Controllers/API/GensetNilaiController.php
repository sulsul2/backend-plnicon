<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\GensetNilai;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GensetNilaiController extends Controller
{
    function all(request $request)
    {
        $genset_nilai = GensetNilai::with(['jadwalPm','genset']);
        return ResponseFormatter::success($genset_nilai->get(), "Get Genset Nilai Successfully");
    }

    function add(request $request){
        try{
            $request->validate([
                'pm_id' => 'required',
                'genset_id' => 'required',
                'fuel' => 'required',
                'hour_meter' => 'required',
                'tegangan_accu' => 'required',
                'tegangan_charger' => 'required',
                'arus_charger' => 'required',
                'fail_over_test' => 'required',
                'temp_on' => 'required',
                'uji_beban_volt' => 'required',
                'uji_beban_arus' => 'required',
                'uji_tanpa_beban_volt' => 'required',
                'uji_tanpa_beban_arus' => 'required',
                'indoor_clean' => 'required',
                'outdoor_clean' => 'required',
            ]);

            $fotoPath = null;
            if($request->file('kartu_gantung_url')){
                $fotoFile = $request->file('fotoFile');
                $fotoPath = $fotoFile->storeAs('public/foto/genset', 'kartugantung_' . date("Y_m_d_h_m_s", time()) . '.' . $fotoFile->extension());
            }

            $genset_nilai = GensetNilai::create([
                'pm_id' => $request->pm_id,
                'genset_id' => $request->genset_id,
                'fuel' => $request->fuel,
                'hour_meter' => $request->hour_meter,
                'tegangan_accu' => $request->tegangan_accu,
                'tegangan_charger' => $request->tegangan_charger,
                'arus_charger' => $request->arus_charger,
                'fail_over_test' => $request->fail_over_test,
                'temp_on' => $request->temp_on,
                'uji_beban_volt' => $request->uji_beban_volt,
                'uji_beban_arus' => $request->uji_beban_arus,
                'uji_tanpa_beban_volt' => $request->uji_tanpa_beban_volt,
                'uji_tanpa_beban_arus' => $request->uji_tanpa_beban_arus,
                'indoor_clean' => $request->indoor_clean,
                'outdoor_clean' => $request->outdoor_clean,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
                'kartu_gantung_url'=>$fotoPath,
            ]);
            return ResponseFormatter::success($genset_nilai, 'Create Data Genset Nilai success');
        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Genset Nilai Failed',
                500,
            );
        }
    }

    function update(request $request){
        try{
            $request->validate([
                'id' => 'required'
            ]);

            $genset_nilai = GensetNilai::find($request->id);
            if (!$genset_nilai) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            if($request->file('kartu_gantung_url')){
                $fotoFile = $request->file('fotoFile');
                $fotoPath = $fotoFile->storeAs('public/foto/genset', 'kartugantung_' . date("Y_m_d_h_m_s", time()) . '.' . $fotoFile->extension());
            }

            $genset_nilai->update([
                'pm_id' => $request->pm_id,
                'genset_id' => $request->genset_id,
                'fuel' => $request->fuel,
                'hour_meter' => $request->hour_meter,
                'tegangan_accu' => $request->tegangan_accu,
                'tegangan_charger' => $request->tegangan_charger,
                'arus_charger' => $request->arus_charger,
                'fail_over_test' => $request->fail_over_test,
                'temp_on' => $request->temp_on,
                'uji_beban_volt' => $request->uji_beban_volt,
                'uji_beban_arus' => $request->uji_beban_arus,
                'uji_tanpa_beban_volt' => $request->uji_tanpa_beban_volt,
                'uji_tanpa_beban_arus' => $request->uji_tanpa_beban_arus,
                'indoor_clean' => $request->indoor_clean,
                'outdoor_clean' => $request->outdoor_clean,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
                'kartu_gantung_url'=>$fotoPath,
            ]);
            return ResponseFormatter::success($genset_nilai, 'Edit Data Genset Nilai success');
        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Genset Nilai Failed',
                500,
            );
        }
    }
}
