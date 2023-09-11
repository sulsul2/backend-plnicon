<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Pdb;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PdbController extends Controller
{
    function all(request $request)
    {
        $pdb = Pdb::with('dataPop');
        if ($request->tipe) {
            $pdb->where('tipe', $request->tipe);
        }
        return ResponseFormatter::success($pdb->get(), "Get Pdb Successfully");
    }

    function add(request $request)
    {
        try {
            $request->validate([
                'pop_id' => 'required',
                'nama' => 'required',
                'tipe' => 'required',
                'arester' => 'required',
                'arester_tipe' => 'required',
                'tgl_instalasi' => 'required',
            ]);

            $pdb = Pdb::create([
                'pop_id' => $request->pop_id,
                'nama' => $request->nama,
                'tipe' => $request->tipe,
                'arester' => $request->arester,
                'arester_tipe' => $request->arester_tipe,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($pdb, 'Create Data Pdb success');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Pdb Failed',
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

            $pdb = Pdb::find($request->id);
            if (!$pdb) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $pdb->update([
                'pop_id' => $request->pop_id,
                'nama' => $request->nama,
                'tipe' => $request->tipe,
                'arester' => $request->arester,
                'arester_tipe' => $request->arester_tipe,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($pdb, 'Edit Data Pdb success');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Pdb Failed',
                500,
            );
        }
    }
}
