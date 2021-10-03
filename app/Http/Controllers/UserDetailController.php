<?php

namespace App\Http\Controllers;

use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDetailController extends Controller
{
    public function store(Request $request){
        // dd($request->all());
        // $this->validate(request(),[
        //     'name' => 'required|string|name',
        //     'phone' => 'required|string',
        //     'gender' => 'required|string',
        //     'address' => 'required|string',
        //     'university' => 'required|string',
        //     'institution' => 'required|string',
        //     'university' => 'required|string',
        //     'files' => 'required|string',
        //     'statement' => 'required|string'
        // ]);
        $data = $request->all();
        $data =  new UserDetail();
        // $data->user_id = Auth::user()->id;
        $data->save();
        return response()->json(["error" => false, "message" => "Updated Successfully.", 'data' => $data]);
    }
    public function getAllUsers(){

        return response()->json(['error' => false, 'users' => UserDetail::all()]);
    }
}
