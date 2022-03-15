<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected function redirectTo()
    {
        if (auth()->user()->group_id == 1) {
            return '/personnel';
        }
        elseif (auth()->user()->group_id == 2) {
            return '/teacher';
        }
        if (auth()->user()->group_id == 3) {
            return '/student';
        }
        return '/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:30'],
            'first_name' => ['required', 'string', 'max:30'],
            'last_name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:30', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:64', 'confirmed'],
        ]);
    }

    //Recieves data from initial registration to be passed into choose user type blade file
    protected function chooseUserType(Request $request)
    {
        //Data retrieved from user's initial registration
        $username = $request->username;
        $email = $request->email;

        //List off groups or user type to use for select options
        $groups = DB::table('tb_groups')->get();

        //if not signed in with google
        if(!(isset($request->google_id))){
            return view('auth.chooseusertype', compact('username', 'email', 'groups'));
        }

        $google_id = $request->google_id;
        return view('auth.chooseusertype', compact('username', 'email', 'groups', 'google_id'));
    }

    //Recieves data from initial registration, and chooseUserType to be passed into complete registration blade file
    protected function continueRegister(Request $request)
    {
        //Data retrieved from user's initial registration
        $username = $request->username;
        $email = $request->email;
        $group_id = $request->group_id; //Group id from choose user type

        //Entities from each table to use for select options
        $offices = DB::table('tb_office')->orderBy('officename', 'ASC')->get();
        $positions = DB::table('tb_positions')->where('group_id', $group_id)->get();

        //if not signed in with google
        if(!(isset($request->google_id))){
            return view('auth.continueregistration', compact('username', 'email', 'group_id', 'offices', 'positions'));
        }

        $google_id = $request->google_id;
        return view('auth.continueregistration', compact('username', 'email', 'group_id', 'offices', 'positions', 'google_id'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        //User creation if user choose to sign in with google
        if(!(isset($data['google_id']))){
            return User::create([
                'username' => $data['username'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'group_id' => $data['group_id'],
                'office_id' => $data['office_id'],
                'position_id' => $data['position_id'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        }else{
            //If user did not choose to sign in with google
            return User::create([
                'username' => $data['username'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'group_id' => $data['group_id'],
                'office_id' => $data['office_id'],
                'position_id' => $data['position_id'],
                'email' => $data['email'],
                'google_id' => $data['google_id'],
                'password' => Hash::make($data['password']),
            ]);
        }

        
    }
}
