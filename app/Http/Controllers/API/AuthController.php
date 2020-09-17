<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request) {
        $data = $request->all();
        $validateData = Validator::make($data, [
            'name' => 'required|string|max:32',
            'email' => 'required|email|unique:users',
            'password' => 'required|max:64'
        ]);

        if ($validateData->fails()) {
            return $this->validationError($validateData);
        } else {
            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);
            return $this->generateAuth($user);
        }
    }

    public function login(Request $request) {
        $data = $request->only('email', 'password');
        $validateData = Validator::make($data, [
           'email' => 'required|email',
           'password' => 'required'
        ]);

        if ($validateData->fails()) {
            return $this->validationError($validateData);
        } else {
            if (!Auth::attempt($data)) {
                return response()->json([
                    'status' => 'ERROR',
                    'msg' => 'Invalid credentials'
                ]);
            } else {
                return $this->generateAuth(Auth::user());
            }
        }
    }

    private function validationError($validator) {
        return response()->json([
            'status' => 'ERROR',
            'errors' => $validator->errors()
        ], 422);
    }

    private function generateAuth($user) {
        $accessToken = $user->createToken('authToken')->accessToken;
        return response()->json([
            'status' => 'OK',
            'access_token' => $accessToken
        ], 201)->cookie('access_token', $accessToken, 10080);
    }
}
