<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Port;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PortController extends Controller
{
    function all(request $request)
    {
        $port = Port::with('perangkat');
        return ResponseFormatter::success($port->get(), "Get Port Successfully");
    }
    function add(request $request)
    {
        try {
            $request->validate([
                'perangkat_id' => 'required',
                'pelanggan_id' => 'required',
                'port_switch' => 'required',
                'tgl_instalasi' => 'required',
            ]);

            $port = Port::create([
                'perangkat_id' => $request->perangkat_id,
                'pelanggan_id' => $request->pelanggan_id,
                'port_switch' => $request->port_switch,
                'odf' => $request->odf,
                'core' => $request->core,
                'converter' => $request->converter,
                'port_converter' => $request->port_converter,
                'cwdm' => $request->cwdm,
                'port_cwdm' => $request->port_cwdm,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($port->load('perangkat'), "Create Port Successfully");
        } catch (ValidationException $error) {
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

    function update(request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
            ]);

            $port = Port::find($request->id);
            if (!$port) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $port->update([
                'perangkat_id' => $request->perangkat_id,
                'pelanggan_id' => $request->pelanggan_id,
                'port_switch' => $request->port_switch,
                'odf' => $request->odf,
                'core' => $request->core,
                'converter' => $request->converter,
                'port_converter' => $request->port_converter,
                'cwdm' => $request->cwdm,
                'port_cwdm' => $request->port_cwdm,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);
            return ResponseFormatter::success($port->load('perangkat'), "Edit port Successfully");
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Update port Failed',
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

            $port = Port::find($request->id);

            if (!$port) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Something when wrong',
                        'error' => "Data Not Found",
                    ],
                    'Delete Data port Failed',
                    404,
                );
            }

            $port->forceDelete();

            return ResponseFormatter::success(
                null,
                'Delete Data port Successfully'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Delete Data port Failed',
                400,
            );
        }
    }
}
