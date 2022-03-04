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
    protected $redirectTo = RouteServiceProvider::HOME;

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

    protected function continueRegister(Request $request)
    {
        $username = $request->username;
        $email = $request->email;
        $groups = DB::table('tb_groups')->get();
        $offices = DB::table('tb_office')->get();
        $positions = DB::table('tb_positions')->get();
        return view('auth.continueregistration', compact('username', 'email', 'groups', 'offices', 'positions'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
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
