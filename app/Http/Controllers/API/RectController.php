<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Rect;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class RectController extends Controller
{
    function all(request $request){
        $rect = Rect::with('datapop');
        return ResponseFormatter::success($rect->get(), "Get Rect Successfully");
    }
    function add(request $request){
        try {
            $request->validate([
                'pop_id' => 'required',
                'merk' => 'required',
                'tipe' => 'required',
                'jumlah_phasa' => 'required',
                'sn' => 'required',
                'slot_modul' => 'required',
                'modul_terpasang' => 'required',
                'modul_control' => 'required',
                'tgl_instalasi' => 'required'
            ]);

            $rect = Rect::create([
                'pop_id' => $request->pop_id,
                'merk' => $request->merk,
                'tipe' => $request->tipe,
                'jumlah_phasa' => $request->jumlah_phasa,
                'sn' => $request->sn,
                'slot_modul' => $request->slot_modul,
                'modul_terpasang' => $request->modul_terpasang,
                'modul_control' => $request->modul_control,
                'tgl_instalasi' => $request->tgl_instalasi,

            ]);
            return ResponseFormatter::success($rect->load('datapop'), "Create Jadwal PM Successfully");

        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Rect Failed',
                500,
            );
        }
    }

    function update(request $request){
        try {
            $request->validate([
                'id' => 'required',
            ]);

            $rect = Rect::find($request->id);
            if(!$rect){
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $rect->update([
                'pop_id' => $request->pop_id,
                'merk' => $request->merk,
                'tipe' => $request->tipe,
                'jumlah_phasa' => $request->jumlah_phasa,
                'sn' => $request->sn,
                'slot_modul' => $request->slot_modul,
                'modul_terpasang' => $request->modul_terpasang,
                'modul_control' => $request->modul_control,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($rect->load('datapop'), "Edit rect Successfully");

        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Update Recti Failed',
                500,
            );
        }
    }
}
