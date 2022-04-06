<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

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
            $data = ['position' => $user_position->name, 'active' => 'resources']; //Variables for sidenav
        } else {
            $layout = 'layouts.teacherLayout';
            $data = ['position' => $user_position->name, 'active' => 'resources']; //Variables for sidenav
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
            $data = ['position' => $user_position->name, 'active' => 'resources']; //Variables for sidenav
        } else {
            $layout = 'layouts.teacherLayout';
            $data = ['position' => $user_position->name, 'active' => 'resources']; //Variables for sidenav
        }
        return view('learningresource.upload', compact('layout', 'data'));
    }

    public function uploadSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required',
            'grade_level' => 'required|numeric|max:12',
            'subject_name' => 'required',
        ]);

        $fileOriginalName = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($fileOriginalName, PATHINFO_FILENAME);
        $filetype = $request->file('file')->getClientOriginalExtension();
        $rawfilesize = $request->file('file')->getSize();
        $filesize = $this->formatSizeUnits($rawfilesize);

        //Suspicious files
        $sus = ['js', 'json', 'exe'];
        if(in_array($filetype, $sus)){
            return back()->with('sus_file', 'Suspicious filetype: \'' . $filetype . '\'. Cannont upload this kind of file! ');
        }

        //Uploaded files are not verified by default if uploaded not uploaded by Personnel usertype
        if(auth()->user()->group_id==1){
            $verified = true;
            $verifiedby = auth()->user()->first_name . ' ' . auth()->user()->last_name;
        }else{
            $verified = false;
            $verifiedby = null;
        }

        DB::table('tb_learningresource')->insert([
            'uploadedbyid' => $request->uploadedbyid,
            'grade_level' => $request->grade_level,
            'subject_name' => $request->subject_name,
            'filename' => $filename,
            'filetype' => $filetype,
            'filesize' => $filesize,
            'filedescription' => $request->filedescription,
            'verified' => $verified,
            'verifiedby' => $verifiedby,
            'created_at' => Carbon::now()
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
            $data = ['position' => $user_position->name, 'active' => 'resources']; //Variables for sidenav
        } else {
            $layout = 'layouts.teacherLayout';
            $data = ['position' => $user_position->name, 'active' => 'resources']; //Variables for sidenav
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

        //Number of students who downloaded the file
        $noOfDownloads = DB::table('tb_downloadedfile')->where('resource_id', $id)->distinct()->count('downloadedbyid');

        //Downloaders
        $downloaders = DB::table('tb_downloadedfile')
        ->join('users', 'tb_downloadedfile.downloadedbyid', 'users.id')
        ->select('users.first_name', 'users.last_name')
        ->where('tb_downloadedfile.resource_id', $id)->get();

        //if file is not an image
        if(! in_array($file->filetype, $image)){
            $filepath = "../../images/docThumnail.jpg";
            return view('learningresource.view', compact('layout', 'data', 'file', 'filepath', 'downloaders', 'noOfDownloads'));
        }
        
        //images as default file
        $filepath = $path;
        return view('learningresource.view', compact('layout', 'data', 'file', 'filepath', 'downloaders', 'noOfDownloads'));
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

        if(Storage::disk('learningresource')->exists($path)){
            return Storage::disk('learningresource')->response($path);
        }else{
            return 'File not found! Must been deleted in its folder!';
        }
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
            $data = ['position' => $user_position->name, 'active' => 'resources']; //Variables for sidenav
        } else {
            $layout = 'layouts.teacherLayout';
            $data = ['position' => $user_position->name, 'active' => 'resources']; //Variables for sidenav
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

    public function updateFile(Request $request)
    {
        $validatedData = $request->validate([
            'filename' => 'required',
            'grade_level' => 'required|numeric|min:1|max:12',
            'subject_name' => 'required',
        ]);

        //rename the file on the directory
        $file = DB::table('tb_learningresource')->where('id', $request->id)->first();
        $old_name = $file->filename . '.' . $file->filetype;
        $new_name = $request->filename. '.' . $file->filetype;

        $uploader = DB::table('users')->where('id', $file->uploadedbyid)->first();
        //To know uploader's user type
        if($uploader->group_id==1){
            $usertype = 'personnels';
        }else{
            $usertype = 'teachers';
        }

        $path = $usertype . '/' . $uploader->id;

        if($new_name!=$old_name){
            Storage::disk('learningresource')->move($path . '/' . $old_name, $path . '/' . $new_name);
        }

        //Update on database
        DB::table('tb_learningresource')->where('id', $request->id)->update([
            'grade_level' => $request->grade_level,
            'subject_name' => $request->subject_name,
            'filename' => $request->filename,
            'filedescription' => $request->filedescription,
            'updated_at' => Carbon::now()
        ]);
        
        return back()->with('file_updated', 'File has been updated successfully!');
    }

    public function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}
