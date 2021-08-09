<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Program;
use App\Models\Module;
use App\Models\Unit;


class ModuleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Getting The module, unit and program by id
    public function viewModule($id)
    {
        $module = Module::where('mod_id', $id)->get();
        $units = Unit::where('module_id', $id)->get();

        $programId = Module::where('mod_id', $id)->value('program_id');
        $program = Program::where('prog_id', $programId)->get();

        return view('moduleView', compact('module', 'units', 'program'));
    }

    // Creating new module
    public function createModule(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                // making sure no two modules have the same name within the programs table

                'mod_name' => [
                    'required', 'string', 'max:255',
                    'unique:modules,mod_name' => Rule::unique('modules')->where(
                        'program_id',
                        $id
                    )
                ],
                'mod_desc' => ['required', 'string', 'max:300'],
                'mod_difficulty' => ['required'],
            ],
            [
                'mod_name.unique' => 'Module name has already been used within this program',
                'mod_difficulty' => 'Module difficulty feild required'
            ]
        );

        $user_id = Auth::user()->u_id;

        $module = new Module;
        $module->mod_name = $request->mod_name;
        $module->mod_desc = $request->mod_desc;
        $module->mod_difficulty = $request->mod_difficulty;
        $module->validated = $request->validated;
        $module->created_by_id = $user_id;
        $module->program_id = $id;

        $module->save();
        return response()->json($module);
    }

    public function updateModule(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'mod_desc' => ['required', 'string', 'max:300'],
                'mod_difficulty' => ['required'],
            ],
            [
                'mod_difficulty' => 'Module difficulty feild required'
            ]
        );

        Module::where('mod_id', $id)->update([
            'mod_name' => $request->mod_name,
            'mod_desc' => $request->mod_desc,
            'mod_difficulty' => $request->mod_difficulty
        ]);
    }


        // deleting module by id
    public function deleteModule($id)
    {
        $module = Module::find($id);
        $module->delete();
    }
}
