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

            //If user already have an account in this app signed in with google
            if($user){
                Auth::login($user);
                if($user->group_id==1){
                    return redirect('/personnel');
                }
                elseif($user->group_id==2){
                    return redirect('/teacher');
                }
                elseif($user->group_id==3){
                    return redirect('/student');
                }
                return redirect('/home');
            }else{
                //If email already exist in the system but not binded on google
                if(DB::table('users')->where('email', $googleUser->email)->first()!=null){
                    $signedUser = User::where('email', $googleUser->email)->first();

                    DB::table('users')->where('email', $googleUser->email)->update([
                        'google_id' => $googleUser->id
                    ]);

                    Auth::login($signedUser);
                    if($signedUser->group_id==1){
                        return redirect('/personnel');
                    }
                    elseif($signedUser->group_id==2){
                        return redirect('/teacher');
                    }
                    elseif($signedUser->group_id==3){
                        return redirect('/student');
                    }
                    return redirect('/home');
                }

                //Data retrieved from user's google account
                $username = $googleUser->name;
                $email = $googleUser->email;
                $google_id = $googleUser->id;

                //List off groups or user type to use for select options
                $groups = DB::table('tb_groups')->get();

                //redirect to continue registration page with data above
                return view('auth.chooseusertype', compact('username', 'email', 'google_id', 'groups'));
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
   }
}