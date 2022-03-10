<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LearningResourceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = auth()->user()->id;
        $uploadedfiles = DB::table('tb_learningresource')->where('uploadedbyid', $user_id)->get();

        //Get the position name from tb_positions using the position_id of the authenticated user
        $user_position = DB::table('users')
        ->join('tb_positions', 'users.position_id', 'tb_positions.id')
        ->select('tb_positions.name')
        ->where('users.id', auth()->user()->id)->first();

        //Determines which layout file to extend base on user type
        if(auth()->user()->group_id==1) {
            //If user is a personnel
            $layout = 'layouts.personnelLayout';
            $data = ['position' => $user_position->name]; //User position at sidenav
        } else {
            $layout = 'layouts.app';
            $data = [];
        }
        return view('learningresource.index', compact('layout', 'data', 'uploadedfiles'));
    }

    public function upload()
    {
        //Get the position name from tb_positions using the position_id of the authenticated user
        $user_position = DB::table('users')
        ->join('tb_positions', 'users.position_id', 'tb_positions.id')
        ->select('tb_positions.name')
        ->where('users.id', auth()->user()->id)->first();

        //Determines which layout file to extend base on user type
        if(auth()->user()->group_id==1) {
            //If user is a personnel
            $layout = 'layouts.personnelLayout';
            $data = ['position' => $user_position->name]; //User position at sidenav
        } else {
            $layout = 'layouts.app';
            $data = [];
        }
        return view('learningresource.upload', compact('layout', 'data'));
    }

    public function uploadSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required',
            'grade_level' => 'required|numeric|min:1|max:12',
            'subject_name' => 'required',
        ]);

        $fileOriginalName = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($fileOriginalName, PATHINFO_FILENAME);
        $filetype = $request->file('file')->getClientOriginalExtension();

        DB::table('tb_learningresource')->insert([
            'uploadedbyid' => $request->uploadedbyid,
            'grade_level' => $request->grade_level,
            'subject_name' => $request->subject_name,
            'filename' => $filename,
            'filetype' => $filetype,
            'filedescription' => $request->filedescription
        ]);

        if(auth()->user()->group_id==1){
            $usertype = 'personnels';
        }else{
            $usertype = 'teachers';
        }
        
        $request->file('file')->storeAs('/' . $usertype . '/' . auth()->user()->id, $fileOriginalName, 'uploads');
        return back()->with('file_uploaded', 'File has been uploaded successfully!');
    }
}
