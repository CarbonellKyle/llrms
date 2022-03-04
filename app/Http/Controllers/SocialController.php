<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SocialController extends Controller
{

public function redirect()
{
    return Socialite::driver('google')->stateless()->redirect();
}

public function callback()
{
    try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('google_id', $googleUser->id)->first();

            //If user already have an account in this app
            if($user){
                Auth::login($user);
                return redirect('/home');
            }else{
                //Data retrieved from user's google account
                $username = $googleUser->name;
                $email = $googleUser->email;
                $google_id = $googleUser->id;

                //Entities from each table to use for select options
                $groups = DB::table('tb_groups')->get();
                $offices = DB::table('tb_office')->get();
                $positions = DB::table('tb_positions')->get();

                //redirect to continue registration page with data above
                return view('auth.continueregistration', compact('username', 'email', 'google_id', 'groups', 'offices', 'positions'));
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
   }
}