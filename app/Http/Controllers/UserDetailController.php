<?php

namespace App\Http\Controllers;

use App\UserDetail;
use Barryvdh\Snappy\Facades\SnappyPdf;
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
        $exists = UserDetail::where('user_id', $request->user_id)->first();
        if (isset($exists)) {
            $exists->update($data);
            if ($_FILES['files']) {
                $info = pathinfo($_FILES['files']['name']);
                $ext = $info['extension'];
                $newname = "profile-" . time() . '.' . $ext;
                $path = Storage::disk('public')->putFileAs('users/documents', new File($_FILES['files']['tmp_name']), $newname);
    
                Storage::disk('public')->setVisibility($path, 'public');
            }
            $exists->files = $path;
            $exists->update();
            return response()->json(["error" => false, "message" => "Updated Successfully.", 'data' => $data]);
        }
        $data =  UserDetail::create($data);
        if ($_FILES['files']) {
            $info = pathinfo($_FILES['files']['name']);
            $ext = $info['extension'];
            $newname = "profile-" . time() . '.' . $ext;
            $path = Storage::disk('public')->putFileAs('users/documents', new File($_FILES['files']['tmp_name']), $newname);

            Storage::disk('public')->setVisibility($path, 'public');
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
    public function generatePdf(Request $request, $id){
        $user = UserDetail::with(['userdetail'])
            ->where(['user_id' => $request->user_id])
            ->first();
        // $headerHtml = view()->make('resume.footer')->render();
//         $user = UserDetail::where('id', $id)->first();
//    $pdf = PDF::loadView('pdfview', ['patients'=>$patients]);
//    return $pdf->download('pdfview.pdf');
        $pdf = SnappyPdf::loadView('pdf.userdetails.pdf', compact('user'))
            ->setOption('margin-bottom', '30mm');
        //        return $pdf->inline('invoice.pdf');
        // $this->storelog($request,Auth::user()->user_profile->full_name.' '.' have generated resume of '.' '.$applicant->user->user_profile->full_name);               
        //        $pdf = SnappyPdf::loadView('resume.pdf', compact('applicant'));
        return $pdf->download('user-details.pdf');
    }
}
