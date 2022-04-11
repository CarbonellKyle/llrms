<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth') && $this->middleware('teacher');
    }

    public function index()
    {
        //Get the position name from tb_positions using the position_id of the authenticated user
        $user_position = DB::table('users')
        ->join('tb_positions', 'users.position_id', 'tb_positions.id')
        ->select('tb_positions.name')
        ->where('users.id', auth()->user()->id)->first();
        $position = $user_position->name; //user's position name

        //Number of students in the teacher's school
        $noOfStudents = count(DB::table('users')->where('group_id', 3)->where('office_id', auth()->user()->office_id)->get()); //Number of Students

        return view('teacherDashboard', compact('position', 'noOfStudents'));
    }

    public function showStudentList()
    {
        //Get the position name from tb_positions using the position_id of the authenticated user
        $user_position = DB::table('users')
        ->join('tb_positions', 'users.position_id', 'tb_positions.id')
        ->select('tb_positions.name')
        ->where('users.id', auth()->user()->id)->first();
        $position = $user_position->name; //user's position name

        $students = DB::table('users')
        ->join('tb_office', 'users.office_id', 'tb_office.id')
        ->join('tb_positions', 'users.position_id', 'tb_positions.id')
        ->select('users.*', 'tb_office.officename', 'tb_office.district', 'tb_positions.name')
        ->where('users.group_id', 3)->where('users.office_id', auth()->user()->office_id)
        ->orderBy('position_id')->get();

        $user_office = DB::table('users')
        ->join('tb_office', 'users.office_id', 'tb_office.id')
        ->select('tb_office.officename')
        ->where('users.id', auth()->user()->id)->first();
        $school = $user_office->officename;

        $numRows = count($students);

        return view('users.students', compact('position', 'students', 'numRows', 'school'));
    }
}
