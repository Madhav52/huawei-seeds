<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Translation\Dumper\YamlFileDumper;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $credentials = $request->only('email', 'password');
        $exists = $this->checkUser($request->email);
        if (!$exists) {
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('authToken')->accessToken;

                return response()->json([
                    'logged_in_user' => $user,
                    'token' => $token,
                ], 200);
            } else {
                return response()->json(
                    ['error' => 'invalid-credentials'],
                    422
                );
            }
        }
        return response()->json(['code' => 405]);
    }
    public function checkUser($email)
    {
        $user = User::where('email', $email)->first();
        if (isset($user->userdetail)) {
            return true;
        } else {
            return false;
        }
    }

    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'string|email|unique:users|required',
            'password' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[#?!@$%^&*-]).{6,}$/'
        ]);
        $user = User::Create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 2,
            'password' => Hash::make($request->password),
        ]);
        $accessToken = $user->createToken('authToken')->accessToken;
        return response()->json([
            'user' => $user,
            'access_token' => $accessToken,
            'message' => 'User Successfully Registered',
            'status_code' => 200
        ], 200);
    }
}
