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
            $data = DataPop::with(['genset', 'inverter', 'kwh', 'ac', 'pdb.mcb', 'environment', 'ex_alarm', 'rect.baterai', 'rect.modul', 'rack.perangkat'])->where('id', $request->id);
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
                'wilayah' => 'required',
                'status' => 'required',
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
                'wilayah' => $request->wilayah,
                'status' => $request->status,
            ]);

            $client = new Client();
            $url = "https://jakban.iconpln.co.id/apisipreman/public/api/pop";

            $headers = [
                // 'Authorization' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOjEsInVzZXJuYW1lIjoiQmFuYW5hIiwiaWF0IjoxNjkwNjI2NTI1fQ.DHP9abrfMYADKbU7b_fAEOa1FhU2xo5rCgYHgIZCDfY',
                'Content-Type' => 'application/form-data'
            ];

            $body = ([
                'POPID' => $request->pop_kode,
                'POPNama' => $request->nama,
                'POPCoordinat' => $request->koordinat,
                'POPAddress' => $request->alamat,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => $request->kecamatan,
                'POPKota' => $request->kota,
                'POPType' => $request->tipe,
                'POPCluster' => '-',
                'POPFeeder' => 0,
                'POPPlanner' => 0,
                'POPConstruct' => '-',
                'CyberKey' => '-',
                'Perapihan' => '-',
                'PIC' => '-',
                'POPWilayah' => '-',
                'kawasan' => '-',
                'padlock' => '-',
                'keymanual' => 0,
                'areahar' => '-',
                'popstat' => '-',
                'sdh' => 0,
                'dwdm' => 0,
                'L3' => 0,
                'kaki' => 0,
                'trunk_kota' => 0,
                'trunk_reg' => 0,
                'trunk_island' => 0,
                'trunk_intl' => 0,
                'bw_trunk_10g' => 0,
                'olt' => 0,
                'POPProject' => '-',
                'flagPm' => 0,
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
            $url = "https://jakban.iconpln.co.id/apisipreman/public/api/edit-pop";

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
