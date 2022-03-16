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
}
