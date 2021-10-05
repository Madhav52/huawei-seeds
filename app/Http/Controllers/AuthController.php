<?php

namespace App\Http\Controllers;

use App\Mail\VerifyMail;
use App\User;
use App\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time())
        ]);
        $verUser = new VerifyMail($user);
        $data["name"] = $verUser->user->name;
        $data["email"] = $verUser->user->email;
        $data["token"] = $verUser->user->verifyUser->token;
        Mail::send('emails.verify-user', $data, function ($message) use ($verUser) {
            $message->from('noreply@seedsnepal.com', 'Seeds Nepal');
            $message->subject("User Activation Link.");
            $message->to($verUser->user->email);
        });
        return response()->json([
            'user' => $user,
            'access_token' => $accessToken,
            'message' => 'User Successfully Registered',
            'status_code' => 200
        ], 200);
    }
    public function verifyUser($token)
    {

        $verifyUser = VerifyUser::where('token', $token)->first();
        if (isset($verifyUser)) {
            $user = $verifyUser->user;
            if ($user) {
                if (!$user->is_verified) {
                    $verifyUser->user->is_verified = 1;
                    $verifyUser->user->save();
                    $status = "Your e-mail is verified. You can now login.";
                    return redirect('/');

                } else {
                    $status = "Your e-mail is already verified. You can now login.";
                    return redirect('/');

                }
            }
        } else {
            return redirect('/')->with('warning', "Sorry your email cannot be identified.");
        }
    
    }
}
