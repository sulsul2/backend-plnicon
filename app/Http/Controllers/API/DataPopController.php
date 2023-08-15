<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\DataPop;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use GuzzleHttp\Client;

class DataPopController extends Controller
{
    function all(request $request)
    {
        $data_pop = DataPop::all();
        if ($request->id) {
            $data = DataPop::with(['genset', 'inverter', 'kwh', 'ac', 'pdb.mcb', 'environment', 'ex_alarm', 'rect.baterai','rect.modul','rack.perangkat'])->where('id', $request->id);
            if (!$data) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }
            return ResponseFormatter::success($data->get(), "Get Data POP Successfully");
        }
        return ResponseFormatter::success($data_pop, 'Get Data POP Successfully');
    }

    function add(request $request)
    {
        try {
            $request->validate([
                'pop_kode' => 'required',
                'nama' => 'required',
                'koordinat' => 'required',
                'alamat' => 'required',
                'kelurahan' => 'required',
                'kecamatan' => 'required',
                'kota' => 'required',
                'building' => 'required',
                'tipe' => 'required',
            ]);

            $data_pop = DataPop::create([
                'pop_kode' => $request->pop_kode,
                'nama' => $request->nama,
                'koordinat' => $request->koordinat,
                'alamat' => $request->alamat,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => $request->kecamatan,
                'kota' => $request->kota,
                'building' => $request->building,
                'tipe' => $request->tipe,
            ]);

            $client = new Client();
            $url = "http://sijakman.test/api/pop";

            $headers = [
                // 'Authorization' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOjEsInVzZXJuYW1lIjoiQmFuYW5hIiwiaWF0IjoxNjkwNjI2NTI1fQ.DHP9abrfMYADKbU7b_fAEOa1FhU2xo5rCgYHgIZCDfY',
                'Content-Type' => 'application/form-data'
            ];

            $body = ([
                    'pop_kode' => $request->pop_kode,
                    'nama' => $request->nama,
                    'koordinat' => $request->koordinat,
                    'alamat' => $request->alamat,
                    'kelurahan' => $request->kelurahan,
                    'kecamatan' => $request->kecamatan,
                    'kota' => $request->kota,
                    'building' => $request->building,
                    'tipe' => $request->tipe,
                ]);

            $response = $client->request('POST', $url, [
                'body' => $body,
                'headers' => $headers,
                'verify'  => false,
            ]);
            return ResponseFormatter::success($data_pop, 'Create Data POP success');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Create Data POP failed',
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

            $data_pop = DataPop::find($request->id);
            if (!$data_pop) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $data_pop->update([
                'pop_kode' => $request->pop_kode,
                'nama' => $request->nama,
                'koordinat' => $request->koordinat,
                'alamat' => $request->alamat,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => $request->kecamatan,
                'kota' => $request->kota,
                'building' => $request->building,
                'tipe' => $request->tipe,
            ]);

            $client = new Client();
            $url = "http://sijakman.test/api/edit-pop";

            $headers = [
                // 'Authorization' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOjEsInVzZXJuYW1lIjoiQmFuYW5hIiwiaWF0IjoxNjkwNjI2NTI1fQ.DHP9abrfMYADKbU7b_fAEOa1FhU2xo5rCgYHgIZCDfY',
                'Content-Type' => 'application/form-data'
            ];

            $body = ([
                    'pop_kode' => $request->pop_kode,
                    'nama' => $request->nama,
                    'koordinat' => $request->koordinat,
                    'alamat' => $request->alamat,
                    'kelurahan' => $request->kelurahan,
                    'kecamatan' => $request->kecamatan,
                    'kota' => $request->kota,
                    'building' => $request->building,
                    'tipe' => $request->tipe,
                ]);

            $response = $client->request('POST', $url, [
                'body' => $body,
                'headers' => $headers,
                'verify'  => false,
            ]);


            return ResponseFormatter::success($data_pop, 'Edit Data POP success');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Edit Data POP failed',
                500,
            );
        }
    }
}
