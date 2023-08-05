<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'nama' => ['required', 'string', 'max:25', 'unique:users', 'min:6'],
                'email' => ['required', 'email:dns', 'string', 'max:255', 'unique:users,email'],
                'username' => ['required', 'string', 'max:25', 'unique:users,username', 'min:6'],
                'password' => ['required', 'string', Password::default()],
                'phone' => ['required', 'string', 'max:15'],
            ]);

            User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
            ]);

            $user = User::where('email', $request->email)->first();

            return ResponseFormatter::success(
                [
                    'user' => $user
                ],
                'User Registered'
            );
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Register Failed',
                500,
            );
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            // Cek apakah ada username dan password yang sesuai
            $credentials = request(['username', 'password']);

            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error(
                    [
                        'message' => 'Unauthorized',
                        'error' => 'Password incorrect'
                    ],
                    'Authentication Failed',
                    500
                );
            }

            $user = User::where('username', $request->username)->first();

            // cek ulang apakah password sesuai (opsional)
            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid Credentials');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'acess_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Authenticated');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Login Failed',
                500,
            );
        }
    }

    public function get(Request $request)
    {
        $user = $request->user();
        return ResponseFormatter::success($user, 'Get user data success');
    }

    public function all(request $request){
        $user = User::all();
        return ResponseFormatter::success($user, 'Get all user data success');
    }

    public function logout(Request $request)
    {
        try {
            $token = $request->user()->currentAccessToken()->delete();
            return ResponseFormatter::success($token, 'Token Revoked');
        } catch (ValidationException $error) {
            return ResponseFormatter::error(
                [
                    'message' => 'Something when wrong',
                    'error' => array_values($error->errors())[0][0],
                ],
                'Logout Failed',
                500,
            );
        }
    }
}
