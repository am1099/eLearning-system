<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        return Validator::make(
            $data,
            [
                'fullname' => ['required', 'string', 'max:255', 'regex:/(.+)( )(.+)/'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'date_of_birth' => ['required', 'date', 'before: -18 years '],
                'password' => ['required', 'string', 'min:8', 'confirmed', 'unique:users'],
                'user_role' => ['required'],
            ],
            [
                'fullname.regex' => 'Incorrect fullame format, please include your first and last name.',
                'date_of_birth.before' => 'Must be at least 18 years old'
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'date_of_birth' => $data['date_of_birth'],
            'password' => Hash::make($data['password']),
            'user_role' => $data['user_role'],
        ]);
    }
}
