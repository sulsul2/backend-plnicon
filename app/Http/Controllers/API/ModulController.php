<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ModulController extends Controller
{
    function all(request $request){
        $modul = Modul::with('rect');
        return ResponseFormatter::success($modul->get(), "Get Modul Successfully");
    }

    function add(request $request){
        try {
            $request->validate([
                'rect_id' => 'required',
                'kapasitas' => 'required',
                'sn' => 'required',
            ]);

            $modul = Modul::create([
                'rect_id' => $request->rect_id,
                'kapasitas' => $request->kapasitas,
                'sn' => $request->sn
            ]);
            return ResponseFormatter::success($modul->load('rect'), "Create Modul Successfully");

        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Modul Failed',
                500,
            );
        }
    }

    function update(request $request){
        try {
            $request->validate([
                'id' => 'required',
            ]);

            $modul = Modul::find($request->id);
            if(!$modul){
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $modul->update([
                'rect_id' => $request->rect_id,
                'kapasitas' => $request->kapasitas,
                'sn' => $request->sn
            ]);
            return ResponseFormatter::success($modul->load('rect'), "Edit Modul Successfully");

        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Update Modul Failed',
                500,
            );
        }
    }
}
