<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;
use App\Models\Module;
use App\Models\Unit;
use App\Models\Lesson;
use App\Models\Activity;


class ProgramController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('newProgram');
    }

    // creating new Program
    public function createProgram(Request $request)
    {
        $this->validate(
            $request,
            [
                // making sure program name is unique
                'prog_name' => ['required', 'string', 'max:255', 'unique:programs'],
                'prog_desc' => ['required', 'string', 'max:300'],
                'prog_type' => ['required'],
                'prog_difficulty' => ['required'],
            ],
            [
                'prog_name.unique' => 'This program name has already been used',
                'prog_desc.required' => 'Program description limit reached!',
                'prog_type.required' => 'Program type required!',
                'prog_difficulty.required' => 'Program difficulty required!'
            ]
        );

        // gettign user id
        $user_id = Auth::user()->u_id;

        // creating new program
        $program = new Program;
        $program->prog_name = $request->prog_name;
        $program->prog_desc = $request->prog_desc;
        $program->prog_type = $request->prog_type;
        $program->prog_difficulty = $request->prog_difficulty;
        $program->validated = $request->validated;
        $program->created_by_id = $user_id;

        $program->save();

        return redirect()->back();
    }

    // get program id with all moduels, units, lessons and activities linked to that program
    public function getProgramById($id)
    {

        $program = Program::where('prog_id', $id)->get();
        $modules = Module::where('program_id', $id)->get();
        $units = Unit::where('program_id', $id)->get();
        $lessons = Lesson::where('program_id', $id)->get();
        $activities = Activity::where('program_id', $id)->get();


        return view('eLearning.programs', compact('program', 'modules', 'units', 'lessons', 'activities'));
    }

    //Getting the count of modules, units, lessons and activities of a specific program
    public function getProgramData($id)
    {
        $moduleId = Module::select('mod_id')->where('program_id', $id)->get();
        $modules = count(Module::where('program_id', $id)->get());

        $unitId = Unit::select('unit_id')->where('module_id', $moduleId)->get();
        $units = count(Unit::where('program_id', $id)->get());

        $lessonId = Lesson::select('les_id')->where('unit_id', $unitId)->get();
        $lessons = count(Lesson::where('program_id', $id)->get());

        $activities = count(Unit::where('program_id', $id)->get());


        $programData = [$modules, $units, $lessons, $activities];

        return $programData;
    }

    // getting program and module by program id
    public function viewProgram($id)
    {
        $program = Program::where('prog_id', $id)->get();
        $modules = Module::where('program_id', $id)->get();

        return view('programView', compact('program', 'modules'));
    }

    // Updating a program by id
    public function updateProgram(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'prog_desc' => ['required', 'string', 'max:300'],
                'prog_type' => ['required'],
                'prog_difficulty' => ['required'],
            ],
            [
                'prog_desc.required' => 'Program description limit reached!',
                'prog_type.required' => 'Program type required!',
                'prog_difficulty.required' => 'Program difficulty required!'
            ]
        );
        Program::where('prog_id', $id)->update([
            'prog_name' => $request->prog_name,
            'prog_desc' => $request->prog_desc,
            'prog_type' => $request->prog_type,
            'prog_difficulty' => $request->prog_difficulty,

        ]);
    }

    // deleting program by id
    public function deleteProgram($id)
    {
        $program = Program::find($id);
        $program->delete();
    }
}
