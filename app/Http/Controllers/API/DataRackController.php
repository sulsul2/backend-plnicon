<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\DataRack;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DataRackController extends Controller
{
    function all(request $request){
        $data_rack = DataRack::with('datapop');
        return ResponseFormatter::success($data_rack->get(), "Get Jadwal PM Successfully");
    }

    function add(request $request){
        try {
            $request->validate([
                'pop_id' => 'required',
                'nomor_rack' => 'required',
                'lokasi' => 'required',
                'tgl_instalasi' => 'required',
            ]);

            $data_rack = DataRack::create([
                'pop_id' => $request->pop_id,
                'nomor_rack' => $request->nomor_rack,
                'lokasi' => $request->lokasi,
                'tgl_instalasi' => $request->tgl_instalasi,
                
            ]);
            return ResponseFormatter::success($data_rack->load('datapop'), "Create Data Rack Successfully");

        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Data Rack Failed',
                500,
            );
        }
    }

    function update(request $request){
        try {
            $request->validate([
                'id' => 'required',
            ]);

            $data_rack = DataRack::find($request->id);
            if(!$data_rack){
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $data_rack->update([
                'pop_id' => $request->pop_id,
                'nomor_rack' => $request->nomor_rack,
                'lokasi' => $request->lokasi,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($data_rack->load('datapop'), "Edit Data rack Successfully");

        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Data Rack Failed',
                500,
            );
        }
    }
}
