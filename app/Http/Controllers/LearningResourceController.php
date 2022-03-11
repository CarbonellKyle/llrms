<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $files = DB::table('tb_learningresource')->where('uploadedbyid', $user_id)->get();
        $numRows = count($files);

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
            $layout = 'layouts.teacherLayout';
            $data = ['position' => $user_position->name]; //User position at sidenav$layout = 'layouts.app';
        }
        return view('learningresource.index', compact('layout', 'data', 'files', 'numRows'));
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
            $layout = 'layouts.teacherLayout';
            $data = ['position' => $user_position->name]; //User position at sidenav$layout = 'layouts.app';
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
        
        $request->file('file')->storeAs('/' . $usertype . '/' . auth()->user()->id, $fileOriginalName, 'learningresource');
        return back()->with('file_uploaded', 'File has been uploaded successfully!');
    }

    public function deleteFile($id)
    {
        $file = DB::table('tb_learningresource')->where('id', $id)->first();
        $filename = $file->filename;
        $fileOriginalName = $filename . '.' . $file->filetype;

        $uploader = DB::table('users')->where('id', $file->uploadedbyid)->first();
        //To know uploader's user type
        if($uploader->group_id==1){
            $usertype = 'personnels';
        }else{
            $usertype = 'teachers';
        }

        $path = $usertype . '/' . $uploader->id . '/' . $fileOriginalName;

        if(Storage::disk('learningresource')->exists($path)){
            Storage::disk('learningresource')->delete($path);
        } else {
            return 'Not Found';
        }

        DB::table('tb_learningresource')->where('id', $id)->delete();

        return back()->with('delete_file', 'File has been deleted!');
    }

    public function viewFile($id)
    {
        //Getting user position
        $user_position = DB::table('users')
        ->join('tb_positions', 'users.position_id', 'tb_positions.id') //To get position name at tb_position
        ->select('users.*', 'tb_positions.name')
        ->where('users.id', auth()->user()->id)->first();

        //Determines which layout file to extend base on user type
        if(auth()->user()->group_id==1) {
            //If user is a personnel
            $layout = 'layouts.personnelLayout';
            $data = ['position' => $user_position->name]; //User position at sidenav
        } else {
            $layout = 'layouts.teacherLayout';
            $data = ['position' => $user_position->name]; //User position at sidenav
        }

        //filetypes
        $image = ['jpg', 'jpeg', 'jfif', 'png', 'gif'];
        $document = ['doc', 'docx', 'pdf', 'ppt'];

        //fetching the file to be viewed
        $file = DB::table('tb_learningresource')->where('id', $id)->first();
        $filename = $file->filename;
        $fileOriginalName = $filename . '.' . $file->filetype;

        $uploader = DB::table('users')->where('id', $file->uploadedbyid)->first();
        //To know uploader's user type
        if($uploader->group_id==1){
            $usertype = 'personnels';
        }else{
            $usertype = 'teachers';
        }

        $path = '/learningresource' . '/' . $usertype . '/' . $uploader->id . '/' . $fileOriginalName;

        //if file is not an image
        if(! in_array($file->filetype, $image)){
            $filepath = "../../images/docThumnail.jpg";
            return view('learningresource.view', compact('layout', 'data', 'file', 'filepath'));
        }
        
        //images as default file
        $filepath = $path;
        return view('learningresource.view', compact('layout', 'data', 'file', 'filepath'));
    }

    public function openFile($id)
    {
        //fetching the file to be viewed
        $file = DB::table('tb_learningresource')->where('id', $id)->first();
        $filename = $file->filename;
        $fileOriginalName = $filename . '.' . $file->filetype;

        $uploader = DB::table('users')->where('id', $file->uploadedbyid)->first();
        //To know uploader's user type
        if($uploader->group_id==1){
            $usertype = 'personnels';
        }else{
            $usertype = 'teachers';
        }

        $path = $usertype . '/' . $uploader->id . '/' . $fileOriginalName;

        return Storage::disk('learningresource')->response($path);
    }

    public function editFile($id)
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
            $layout = 'layouts.teacherLayout';
            $data = ['position' => $user_position->name]; //User position at sidenav$layout = 'layouts.app';
        }

        //filetypes
        $image = ['jpg', 'jpeg', 'jfif', 'png', 'gif'];
        $document = ['doc', 'docx', 'pdf', 'ppt'];

        //Getting learningresource info from data base
        $file = DB::table('tb_learningresource')->where('id', $id)->first();
        $filename = $file->filename;
        $fileOriginalName = $filename . '.' . $file->filetype;

        $uploader = DB::table('users')->where('id', $file->uploadedbyid)->first();
        //To know uploader's user type
        if($uploader->group_id==1){
            $usertype = 'personnels';
        }else{
            $usertype = 'teachers';
        }

        $path = '/learningresource' . '/' . $usertype . '/' . $uploader->id . '/' . $fileOriginalName;

        //if file is not an image
        if(! in_array($file->filetype, $image)){
            $filepath = "../../images/docThumnail.jpg";
            return view('learningresource.edit', compact('layout', 'data', 'file', 'filepath'));
        }
        
        //images as default file
        $filepath = $path;
        return view('learningresource.edit', compact('layout', 'data', 'file', 'filepath'));
    }

    public function updateFile()
    {
        return 'Developer is currently working on this function';
    }
}
