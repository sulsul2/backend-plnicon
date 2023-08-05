<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Mcb;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class McbController extends Controller
{
    function all(request $request)
    {
        $mcb = Mcb::with('pdb');
        return ResponseFormatter::success($mcb->get(), "Get Mcb Successfully");
    }

    function add(request $request){
        try{
            $request->validate([
                'pdb_id' => 'required',
                'nama' => 'required',
                'jumlah_phasa' => 'required',
                'merk' => 'required',
                'kapasitas' => 'required',
                'a_terukur' => 'required',
                'tipe' => 'required',
                'tgl_instalasi' => 'required',
            ]);

            $mcb = Mcb::create([
                'pdb_id' => $request->pdb_id,
                'nama' => $request->nama,
                'jumlah_phasa' => $request->jumlah_phasa,
                'merk' => $request->merk,
                'kapasitas' => $request->kapasitas,
                'a_terukur' => $request->a_terukur,
                'tipe' => $request->tipe,
                'peruntukan' => $request->peruntukan,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($mcb, 'Create Data Mcb success');
        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Mcb Failed',
                500,
            );
        }
    }

    function update(request $request){
        try{
            $request->validate([
                'id' => 'required'
            ]);

            $mcb = Mcb::find($request->id);
            if (!$mcb) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $mcb->update([
                'pdb_id' => $request->pdb_id,
                'nama' => $request->nama,
                'jumlah_phasa' => $request->jumlah_phasa,
                'merk' => $request->merk,
                'kapasitas' => $request->kapasitas,
                'a_terukur' => $request->a_terukur,
                'tipe' => $request->tipe,
                'peruntukan' => $request->peruntukan,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($mcb, 'Edit Data Mcb success');
        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Mcb Failed',
                500,
            );
        }
    }
}
