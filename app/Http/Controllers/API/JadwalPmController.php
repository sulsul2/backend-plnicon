<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\JadwalPm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class JadwalPmController extends Controller
{
    function all(request $request){
        $jadwal_pm = JadwalPm::with(['datapop','user']);
        return ResponseFormatter::success($jadwal_pm->get(), "Get Jadwal PM Successfully");
    }

    function getByUser(request $request){
        $id = Auth::id();
        $jadwal_pm = JadwalPm::with('datapop')->where('user_id',$id);
        return ResponseFormatter::success($jadwal_pm->get(), "Get Jadwal PM Successfully");
    }

    function add(request $request){
        try {
            $request->validate([
                'pop_id' => 'required',
                'user_id' => 'required',
                'plan' => 'required',
                'realisasi' => 'required',
                'jenis' => 'required',
                'kategori' => 'required',
                'detail_pm' => 'required',
                'wilayah' => 'required',
                'area' => 'required'
            ]);

            $jadwal_pm = JadwalPm::create([
                'pm_kode' => "PM".$request->plan,
                'pop_id' => $request->pop_id,
                'user_id' => $request->user_id,
                'plan' => $request->plan,
                'realisasi' => $request->realisasi,
                'jenis' => $request->jenis,
                'kategori' => $request->kategori,
                'detail_pm' => $request->detail_pm,
                'hostname' => $request->hostname,
                'fat_id' => $request->fat_id,
                'wilayah' => $request->wilayah,
                'area' => $request->area,
                'lokasi_osp' => $request->lokasi_osp,
                'koordinat_awal' => $request->koordinat_awal,
                'koordinat_akhir' => $request->koordinat_akhir,
                'dokumen_osp' => $request->dokumen_osp,

            ]);
            return ResponseFormatter::success($jadwal_pm->load(['datapop','user']), "Create Jadwal PM Successfully");

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

            $jadwal_pm = JadwalPm::find($request->id);
            if(!$jadwal_pm){
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $jadwal_pm->update([
                'status' => $request->status,
                'status_approval' => $request->status_approval,
                'plan' => $request->plan,
                'realisasi' => $request->realisasi,
                'jenis' => $request->jenis,
                'kategori' => $request->kategori,
                'detail_pm' => $request->detail_pm,
                'hostname' => $request->hostname,
                'fat_id' => $request->fat_id,
                'wilayah' => $request->wilayah,
                'area' => $request->area,
                'lokasi_osp' => $request->lokasi_osp,
                'koordinat_awal' => $request->koordinat_awal,
                'koordinat_akhir' => $request->koordinat_akhir,
                'dokumen_osp' => $request->dokumen_osp,

            ]);
            return ResponseFormatter::success($jadwal_pm->load(['datapop','user']), "Edit Jadwal PM Successfully");

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
}
