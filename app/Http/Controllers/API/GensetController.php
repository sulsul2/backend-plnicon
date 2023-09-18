<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Genset;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GensetController extends Controller
{
    function all(request $request)
    {
        $genset = Genset::with('dataPop');
        if ($request->pop_id) {
            $genset->where('pop_id', $request->pop_id);
            if (!$genset) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }
            return ResponseFormatter::success($genset->get(), "Get Genset by Pop Id Successfully");
        }
        return ResponseFormatter::success($genset->get(), "Get Genset Successfully");
    }

    function add(request $request)
    {
        try {
            $request->validate([
                'pop_id' => 'required',
                'merk' => 'required',
                'kapasitas' => 'required',
                'sn' => 'required',
                'merk_engine' => 'required',
                'merk_gen' => 'required',
                'max_fuel' => 'required',
                'bahan_bakar' => 'required',
                'accu' => 'required',
                'merk_accu' => 'required',
                'tipe_batt_charger' => 'required',
                'switch' => 'required',
                'tgl_instalasi' => 'required',
            ]);

            $genset = Genset::create([
                'pop_id' => $request->pop_id,
                'merk' => $request->merk,
                'kapasitas' => $request->kapasitas,
                'sn' => $request->sn,
                'merk_engine' => $request->merk_engine,
                'merk_gen' => $request->merk_gen,
                'max_fuel' => $request->max_fuel,
                'bahan_bakar' => $request->bahan_bakar,
                'accu' => $request->accu,
                'merk_accu' => $request->merk_accu,
                'tipe_batt_charger' => $request->tipe_batt_charger,
                'switch' => $request->switch,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($genset, 'Create Data Genset success');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Genset Failed',
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

            $genset = Genset::find($request->id);
            if (!$genset) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $genset->update([
                'pop_id' => $request->pop_id,
                'merk' => $request->merk,
                'kapasitas' => $request->kapasitas,
                'sn' => $request->sn,
                'merk_engine' => $request->merk_engine,
                'merk_gen' => $request->merk_gen,
                'max_fuel' => $request->max_fuel,
                'bahan_bakar' => $request->bahan_bakar,
                'accu' => $request->accu,
                'merk_accu' => $request->merk_accu,
                'tipe_batt_charger' => $request->tipe_batt_charger,
                'switch' => $request->switch,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($genset, 'Edit Data Genset success');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Genset Failed',
                500,
            );
        }
    }

    function delete(request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
            ]);

            $genset = Genset::find($request->id);

            if (!$genset) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Something when wrong',
                        'error' => "Data Not Found",
                    ],
                    'Delete Data genset Failed',
                    404,
                );
            }

            $genset->forceDelete();

            return ResponseFormatter::success(
                null,
                'Delete Data genset Successfully'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Delete Data genset Failed',
                400,
            );
        }
    }
}
