<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Environment;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EnvironmentController extends Controller
{
    function all(request $request)
    {
        $environment = Environment::with(['jadwalPm', 'dataPop', 'foto']);
        if ($request->pm_id && $request->pop_id) {
            $environment->where('pm_id', $request->pm_id)->where('pop_id', $request->pop_id)->first();
            if (!$environment) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }
            return ResponseFormatter::success($environment->get(), "Get Environment Successfully");
        }
        return ResponseFormatter::success($environment->get(), "Get Environment Successfully");
    }

    function add(request $request)
    {
        try {
            $request->validate([
                'pop_id' => 'required',
                'pm_id' => 'required',
                'exhaust' => 'required',
                'kebersihan_exhaust' => 'required',
                'lampu' => 'required',
                'jumlah_lampu' => 'required',
                'suhu_ruangan' => 'required',
                'bangunan' => 'required',
                'kebersihan_bangunan' => 'required',
                'tgl_instalasi' => 'required',
            ]);

            $environment = Environment::create([
                'pop_id' => $request->pop_id,
                'pm_id' => $request->pm_id,
                'exhaust' => $request->exhaust,
                'kebersihan_exhaust' => $request->kebersihan_exhaust,
                'lampu' => $request->lampu,
                'jumlah_lampu' => $request->jumlah_lampu,
                'suhu_ruangan' => $request->suhu_ruangan,
                'bangunan' => $request->bangunan,
                'kebersihan_bangunan' => $request->kebersihan_bangunan,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);

            return ResponseFormatter::success($environment, 'Create Environment success');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Create Environment failed',
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

            $environment = Environment::find($request->id);
            if (!$environment) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $environment->update([
                'pop_id' => $request->pop_id,
                'pm_id' => $request->pm_id,
                'exhaust' => $request->exhaust,
                'kebersihan_exhaust' => $request->kebersihan_exhaust,
                'lampu' => $request->lampu,
                'jumlah_lampu' => $request->jumlah_lampu,
                'suhu_ruangan' => $request->suhu_ruangan,
                'bangunan' => $request->bangunan,
                'kebersihan_bangunan' => $request->kebersihan_bangunan,
                'temuan' => $request->temuan,
                'rekomendasi' => $request->rekomendasi,
                'tgl_instalasi' => $request->tgl_instalasi,
            ]);

            return ResponseFormatter::success($environment, 'Edit Environment success');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Edit Environment failed',
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

            $environment = Environment::find($request->id);

            if (!$environment) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Something when wrong',
                        'error' => "Data Not Found",
                    ],
                    'Delete Data environment Failed',
                    404,
                );
            }

            $environment->forceDelete();

            return ResponseFormatter::success(
                null,
                'Delete Data environment Successfully'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Delete Data environment Failed',
                400,
            );
        }
    }
}
