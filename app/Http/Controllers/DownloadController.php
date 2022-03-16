<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class DownloadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth') && $this->middleware('student');
    }

    public function download(Request $request)
    {
        $file = DB::table('tb_learningresource')->where('id', $request->file_id)->first();
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
            //Store Download info to Database
            DB::table('tb_downloadedfile')->insert([
                'resource_id' => $request->file_id,
                'downloadedbyid' => auth()->user()->id,
                'created_at' => Carbon::now()
            ]);
            
            //Download File
            return Storage::disk('learningresource')->download($path);
        }
        return redirect('/404');
    }

    public function previewFile($id)
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
}
