<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
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

    public function index()
    {
        $position_code = DB::table('users')
        ->join('tb_positions', 'users.position_id', 'tb_positions.id') //To get position_code at tb_position
        ->select('tb_positions.code')
        ->where('users.id', auth()->user()->id)->first();
        $grade_level = $position_code->code;
        
        $files = DB::table('tb_learningresource')->where('grade_level', $grade_level)->get();
        $numRows = count($files);

        return view('welcome', compact('files', 'numRows'));
    }
}
