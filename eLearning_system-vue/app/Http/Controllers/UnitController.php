<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Module;
use App\Models\Unit;
use App\Models\Lesson;


use Illuminate\Http\Request;

class UnitController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

        // Getting The lesson, unit and module by id

    public function viewUnit($id)
    {
        $unit = Unit::where('unit_id', $id)->get();
        $lessons = Lesson::where('unit_id', $id)->get();

        $moduleId = Unit::where('unit_id', $id)->value('module_id');
        $module = Module::where('mod_id', $moduleId)->get();

        return view('unitView', compact('unit', 'lessons', 'module'));
    }

    public function createUnit(Request $request, $id)
    {
        $module = Module::select('program_id')->where('mod_id', $id)->first();


        $this->validate(
            $request,
            [
                // making sure no two units have the same name within the Modules table

                'unit_name' => [
                    'required', 'string', 'max:255',
                    'unique:units,unit_name' => Rule::unique('units')->where('module_id', $id)
                ],
                'unit_desc' => ['required', 'string', 'max:300'],
                'unit_difficulty' => ['required'],
            ],
            [
                'unit_name.unique' => 'Unit name already used within this Module',
                'unit_difficulty' => 'Unit difficulty required'
            ]
        );

        // getting user id
        $user_id = Auth::user()->u_id;

        //creating new unit
        $unit = new Unit;
        $unit->unit_name = $request->unit_name;
        $unit->unit_desc = $request->unit_desc;
        $unit->unit_difficulty = $request->unit_difficulty;
        $unit->validated = $request->validated;
        $unit->created_by_id = $user_id;
        $unit->module_id = $id;
        $unit->program_id = $module->program_id;


        $unit->save();
        return response()->json($unit);
    }

    // updating unit by id
    public function updateUnit(Request $request, $id)
    {
        $this->validate(
            $request,
            [

                'unit_desc' => ['required', 'string', 'max:300'],
                'unit_difficulty' => ['required'],
            ],
            [
                'unit_difficulty' => 'Unit difficulty required'
            ]
        );

        Unit::where('unit_id', $id)->update([
            'unit_name' => $request->unit_name,
            'unit_desc' => $request->unit_desc,
            'unit_difficulty' => $request->unit_difficulty,
        ]);
    }

    // deleting unit by id
    public function deleteUnit($id)
    {
        $unit = Unit::find($id);
        $unit->delete();
    }
}
