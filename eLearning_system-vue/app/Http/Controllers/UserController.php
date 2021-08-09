<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use App\Models\StudentUser;
use App\Models\Program;
use App\Models\Module;
use App\Models\Unit;
use App\Models\Lesson;
use App\Models\Activity;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function getAllUsers()
    {
        $users = User::all();
        return $users;
    }

    public function addNewUser(Request $request)
    {
        // validating all the key inputs
        $this->validate(
            $request,
            [
                //makes sure the user inputs a fullname
                'fullname' => ['required', 'string', 'max:255', 'regex:/(.+)( )(.+)/'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                //makes sure the user is at least 18 years old
                'date_of_birth' => ['required', 'date', 'before: -18 years '],
                'password' => ['required', 'string', 'min:8', 'unique:users'],
                'user_role' => ['required'],
            ],
            [
                'fullname.regex' => 'Incorrect fullame format, please include your first and last name.',
                'date_of_birth.before' => 'Must be at least 18 years old'
            ]

        );

        // creating a new user
        $user = new User;
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;
        $user->password = Hash::make($request->password);
        $user->user_role = $request->user_role;
        $user->save();

        return $user;
    }

    public function updateUser(Request $request, $id)
    {
        // validating all the key inputs
        $this->validate(
            $request,
            [
                'fullname' => ['required', 'string', 'max:255', 'regex:/(.+)( )(.+)/'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'date_of_birth' => ['required', 'date', 'before: -18 years '],
                'user_role' => ['required'],
            ],
            [
                'fullname.regex' => 'Incorrect fullame format, please include your first and last name.',
                'date_of_birth.before' => 'Must be at least 18 years old'
            ]

        );

        // update user details
        User::where('u_id', $id)->update([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'user_role' => $request->user_role,

        ]);
    }

    public function deleteUser($id)
    {
        // delete user by id
        $user = User::find($id);
        $user->delete();
    }

    // one function that validates a program, module, unit, lesson or aactivity by id and type sent
    public function validation(Request $request, $id)
    {

        if ($request[0] == "program") {
            Program::where('prog_id', $id)->update([
                'validated' => true,
            ]);
        } else if ($request[0] == 'module') {
            Module::where('mod_id', $id)->update([
                'validated' => true,
            ]);
        } else if ($request[0] == 'unit') {
            Unit::where('unit_id', $id)->update([
                'validated' => true,
            ]);
        } else if ($request[0] == 'lesson') {
            Lesson::where('les_id', $id)->update([
                'validated' => true,
            ]);
        } else if ($request[0] == 'activity') {
            Activity::where('act_id', $id)->update([
                'validated' => true,
            ]);
        }
    }
}
