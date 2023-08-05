<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NotifikasiController extends Controller
{
    function all(request $request){
        $notifikasi = Notifikasi::with('user');
        return ResponseFormatter::success($notifikasi->get(), "Get Notifikasi Successfully");
    }

    function add(request $request){
        try {
            $request->validate([
                'user_id' => 'required',
                'role' => 'required',
                'deskripsi' => 'required',
                'status' => 'required',
            ]);

            $notifikasi = Notifikasi::create([
                'user_id' => $request->user_id,
                'role' => $request->role,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ]);
            return ResponseFormatter::success($notifikasi->load('user'), "Create Notifikasi Successfully");

        }catch(ValidationException $error){
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Add Notifikasi Failed',
                500,
            );
        }
    }

    function update(request $request){
        try {
            $request->validate([
                'id' => 'required',
            ]);

            $notifikasi = Notifikasi::find($request->id);
            if(!$notifikasi){
                return ResponseFormatter::error(
                    null,
                    'Data not found',
                    404
                );
            }

            $notifikasi->update([
                'user_id' => $request->user_id,
                'role' => $request->role,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
            ]);
            return ResponseFormatter::success($notifikasi->load('user'), "Edit Notifikasi Successfully");

        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Update Baterai Failed',
                500,
            );
        }
    }
}
