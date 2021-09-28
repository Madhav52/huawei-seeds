<?php

namespace App\Http\Controllers;

use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){

    }

    public function register(Request $request){
        $request->validate([
            'full_name' => 'required',
            'email' => 'string|email|unique|required',
            'password' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[#?!@$%^&*-]).{6,}$/'
        ]);
        $user = UserDetail::Create([
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            'user' => $user,
            'message' => 'User Successfully Registered',
            'status_code' => 200
        ], 200);
    }

    public function logout(){

    }
}
