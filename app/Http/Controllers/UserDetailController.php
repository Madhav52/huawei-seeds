<?php

namespace App\Http\Controllers;

use App\UserDetail;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserDetailController extends Controller
{
    public function store(Request $request)
    {
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
        $data =  UserDetail::create($data);
        if ($_FILES['files']) {
            $info = pathinfo($_FILES['file']['name']);
            $ext = $info['extension'];
            $newname = $request->name . "-profile-" . time() . '.' . $ext;
            $path = Storage::disk('local')->putFileAs('public/users/profile', new File($_FILES['file']['tmp_name']), $newname);

            Storage::disk('local')->setVisibility($path, 'public');
        }
        $data->files = $path;
        $data->update();

        // $data->user_id = Auth::user()->id;
        return response()->json(["error" => false, "message" => "Updated Successfully.", 'data' => $data]);
    }
    public function getAllUsers()
    {

        return response()->json(['error' => false, 'users' => UserDetail::all()]);
    }
}
