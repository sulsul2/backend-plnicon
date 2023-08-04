<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Temuan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TemuanController extends Controller
{
    public function all(Request $request)
    {
        $temuan_id = $request->input('id');

        $temuan = Temuan::with(['jadwalPm', 'dataPop']);

        if ($temuan_id) {
            $temuan->where('id', $temuan_id)->first();
        }

        return ResponseFormatter::success(
            $temuan->get(),
            'Get Temuan Successfully'
        );
    }

    public function add(Request $request)
    {
        try {
            $request->validate([
                'pm_id' => 'required',
                'pop_id' => 'required',
                'hasil' => 'string',
            ]);

            $temuan = Temuan::create([
                'pm_id' => $request->pm_id,
                'pop_id' => $request->pop_id,
                'hasil' => $request->hasil,
            ]);

            return ResponseFormatter::success(
                $temuan->load(['jadwalPm','dataPop']),
                'Create Temuan Successfully'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Create Temuan Failed',
                500,
            );
        }
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
                'pm_id' => 'required',
                'pop_id' => 'required',
                'status' => 'required|in:CHECK,PLAN,REALISASI',
                'hasil' => 'string',
            ]);

            $temuan = Temuan::find($request->id);

            if (!$temuan) {
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $temuan->update([
                'pm_id' => $request->pm_id,
                'pop_id' => $request->pop_id,
                'status' => $request->status,
                'hasil' => $request->hasil,
            ]);

            return ResponseFormatter::success(
                $temuan->load(['jadwalPm', 'dataPop']),
                'Edit Temuan Successfully'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Edit Temuan Failed',
                500,
            );
        }
    }
}
