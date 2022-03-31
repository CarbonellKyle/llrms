<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonnelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth') && $this->middleware('personnel');
    }

    public function index()
    {
        //Get the position name from tb_positions using the position_id of the authenticated user
        $user_position = DB::table('users')
        ->join('tb_positions', 'users.position_id', 'tb_positions.id')
        ->select('tb_positions.name')
        ->where('users.id', auth()->user()->id)->first();
        $position = $user_position->name; //user's position name

        $noOfPersonnels = count(DB::table('users')->where('group_id', 1)->get()); //Number of Personnels
        $noOfTeachers = count(DB::table('users')->where('group_id', 2)->get()); //Number of Teachers
        $noOfStudents = count(DB::table('users')->where('group_id', 3)->get()); //Number of Students


        return view('personnelDashboard', compact('position', 'noOfTeachers', 'noOfStudents', 'noOfPersonnels'));
    }

    public function displayUnverified()
    {
        //Get the position name from tb_positions using the position_id of the authenticated user
        $user_position = DB::table('users')
        ->join('tb_positions', 'users.position_id', 'tb_positions.id')
        ->select('tb_positions.name')
        ->where('users.id', auth()->user()->id)->first();
        $position = $user_position->name; //user's position name

        $files = DB::table('tb_learningresource')
        ->join('users', 'tb_learningresource.uploadedbyid', 'users.id')
        ->select('tb_learningresource.*', 'users.first_name', 'users.last_name')
        ->where('verified', false)->get();
        $numRows = count($files);

        return view('learningresource.displayUnverified', compact('position', 'files', 'numRows'));
    }

    public function addRemarks(Request $request)
    {
        DB::table('tb_learningresource')->where('id', $request->file_id)->update([
            'remarks' => $request->remarks,
            'reviewedby' => auth()->user()->first_name . ' ' . auth()->user()->last_name
        ]);

        return back()->with('review_submitted', 'Your review has been submitted!');
    }

    public function verifyFile(Request $request)
    {
        DB::table('tb_learningresource')->where('id', $request->file_id)->update([
            'verified' => true,
            'verifiedby' => auth()->user()->first_name . ' ' . auth()->user()->last_name
        ]);

        return back()->with('file_verified', 'File has been verified successfully');
    }

    public function showTeacherList()
    {
        //Get the position name from tb_positions using the position_id of the authenticated user
        $user_position = DB::table('users')
        ->join('tb_positions', 'users.position_id', 'tb_positions.id')
        ->select('tb_positions.name')
        ->where('users.id', auth()->user()->id)->first();
        $position = $user_position->name; //user's position name

        $teachers = DB::table('users')
        ->join('tb_office', 'users.office_id', 'tb_office.id')
        ->join('tb_positions', 'users.position_id', 'tb_positions.id')
        ->select('users.*', 'tb_office.officename', 'tb_office.district', 'tb_positions.name')
        ->where('users.group_id', 2)->get();

        $numRows = count($teachers);

        return view('users.teachers', compact('position', 'teachers', 'numRows'));
    }
}
