<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $offices = DB::table('tb_office')->orderBy('officename', 'ASC')->get();
        $user_office = DB::table('users')
        ->join('tb_office', 'users.office_id', 'tb_office.id') //To get officename at tb_office
        ->select('users.*', 'tb_office.officename')
        ->where('users.id', auth()->user()->id)->first();

        $positions = DB::table('tb_positions')->where('group_id', auth()->user()->group_id)->get();
        $user_position = DB::table('users')
        ->join('tb_positions', 'users.position_id', 'tb_positions.id') //To get officename at tb_office
        ->select('users.*', 'tb_positions.name')
        ->where('users.id', auth()->user()->id)->first();

        //Determines which layout file to extend base on user type
        if(auth()->user()->group_id==1) {
            //If user is a personnel
            $layout = 'layouts.personnelLayout';
            $data = ['position' => $user_position->name]; //User position at sidenav
        }
        if(auth()->user()->group_id==2) {
            //If user is a teacher
            $layout = 'layouts.teacherLayout';
            $data = ['position' => $user_position->name]; //User position at sidenav
        } else {
            $layout = 'layouts.app';
            $data = ['position' => $user_position->name]; //User position at sidenav
        }

        return view('profile.edit', compact('layout', 'data', 'offices', 'user_office', 'positions', 'user_position'));
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
