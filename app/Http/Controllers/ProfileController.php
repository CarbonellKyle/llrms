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
        $offices = DB::table('tb_office')->get();
        $user_office = DB::table('users')
        ->join('tb_office', 'users.office_id', 'tb_office.id') //To get officename at tb_office
        ->select('users.*', 'tb_office.officename')
        ->where('users.id', auth()->user()->id)->first();

        $positions = DB::table('tb_positions')->get();
        $user_position = DB::table('users')
        ->join('tb_positions', 'users.position_id', 'tb_positions.id') //To get officename at tb_office
        ->select('users.*', 'tb_positions.name')
        ->where('users.id', auth()->user()->id)->first();

        return view('profile.edit', compact('offices', 'user_office', 'positions', 'user_position'));
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
