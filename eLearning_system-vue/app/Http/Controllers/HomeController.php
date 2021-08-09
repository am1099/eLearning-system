<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StudentUser;
use App\Models\Program;
use App\Models\Module;
use App\Models\Unit;
use App\Models\Lesson;
use App\Models\Activity;


class HomeController extends Controller
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
    public function index()
    {
        $prog = Program::all();
        return view('eLearning.home', compact('prog'));
    }

    // Function to count the number of programs, modules, units, lessons and activities
    public function dashboardView()
    {
        $prog = Program::all();
        $modules = Module::all();
        $units = Unit::all();
        $lessons = Lesson::all();
        $activities = Activity::all();

        $numOf_stats = [
            'Programs' => $prog->count(),
            'Modules' => $modules->count(),
            'Units' => $units->count(),
            'Lessons' => $lessons->count(),
            'Activities' => $activities->count(),
        ];

        $object = (object) $numOf_stats;

        // Number of Vallidated programs etc
        $programV = count(Program::where('validated', true)->get());
        $modulesV = count(Module::where('validated', true)->get());
        $unitsV = count(Unit::where('validated', true)->get());
        $lessonsV = count(Lesson::where('validated', true)->get());
        $activitiesV = count(Activity::where('validated', true)->get());

        $validatedPrograms = [$programV, $modulesV, $unitsV, $lessonsV, $activitiesV];
        return view('dashboard', compact('prog', 'object','validatedPrograms'));
    }

    public function membershipView()
    {
        return view('eLearning.membership');
    }

    // Getting statistics for the Admin homepage
    public function dashboardStats()
    {

        $users = count(User::all());
        $studentUsers = count(StudentUser::all());
        $allPrograms = count(Program::all());
        $validatedPrograms = count(Program::where('validated', true)->get());

        $stats = [$users, $studentUsers, $allPrograms, $validatedPrograms];

        return $stats;
    }


    // Getting statistics for Admin program specification
    public function displayUserData()
    {
        $prog = Program::all();
        $modules = Module::all();
        $units = Unit::all();
        $lessons = Lesson::all();
        $activities = Activity::all();

        $numOf_stats = [
            'Programs' => $prog->count(),
            'Modules' => $modules->count(),
            'Units' => $units->count(),
            'Lessons' => $lessons->count(),
            'Activities' => $activities->count(),
        ];

        $object = (object) $numOf_stats;

        return view('programSpec', compact('prog', 'object'));
    }

    // Funtion that fetchs the number of validated and non validated P/M/U/L/S
    public function validatedPrograms()
    {
        // Vallidated programs
        $programV = count(Program::where('validated', true)->get());
        $modulesV = count(Module::where('validated', true)->get());
        $unitsV = count(Unit::where('validated', true)->get());
        $lessonsV = count(Lesson::where('validated', true)->get());
        $activitiesV = count(Activity::where('validated', true)->get());

        $Vprograms = [$programV, $modulesV, $unitsV, $lessonsV, $activitiesV];


        // Not Vallidated programs
        $programNV = count(Program::where('validated', false)->get());
        $modulesNV = count(Module::where('validated', false)->get());
        $unitsNV = count(Unit::where('validated', false)->get());
        $lessonsNV = count(Lesson::where('validated', false)->get());
        $activitiesNV = count(Activity::where('validated', false)->get());


        $NVprograms = [$programNV, $modulesNV, $unitsNV, $lessonsNV, $activitiesNV];

        return [$Vprograms, $NVprograms];
    }
}
