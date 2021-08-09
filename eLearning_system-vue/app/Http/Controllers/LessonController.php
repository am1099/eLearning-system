<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Unit;
use App\Models\Lesson;
use App\Models\Activity;


class LessonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Getting The unit, lesson and activity by id
    public function viewLesson($id)
    {
        $lesson = Lesson::where('les_id', $id)->get();
        $activities = Activity::where('lesson_id', $id)->get();

        $unitId = Lesson::where('les_id', $id)->value('unit_id');
        $unit = Unit::where('unit_id', $unitId)->get();

        return view('lessonView', compact('lesson', 'activities', 'unit'));
    }

    // Creating a new lesson
    public function createLesson(Request $request, $id)
    {
        $unit = Unit::select('program_id')->where('unit_id', $id)->first();

        $this->validate(
            $request,
            [
                // making sure no two lessons have the same name within the units table
                'les_name' => [
                    'required', 'string', 'max:255',
                    'unique:units,unit_name' => Rule::unique('lessons')->where('unit_id', $id)
                ],
                'les_desc' => ['required', 'string', 'max:300'],
                'les_difficulty' => ['required'],
            ],
            [
                'les_name.unique' => 'Lesson name already used within this Unit',
                'les_difficulty' => 'Lesson difficulty required'
            ]
        );

        $user_id = Auth::user()->u_id;

        // creating a new row in the database
        $lesson = new Lesson;
        $lesson->les_name = $request->les_name;
        $lesson->les_desc = $request->les_desc;
        $lesson->les_difficulty = $request->les_difficulty;
        $lesson->validated = $request->validate;
        $lesson->created_by_id = $user_id;
        $lesson->unit_id = $id;
        $lesson->program_id = $unit->program_id;


        $lesson->save();
        return response()->json($lesson);
    }

    // Updating lesson
    public function updateLesson(Request $request, $id)
    {
        $this->validate(
            $request,
            [

                'les_desc' => ['required', 'string', 'max:300'],
                'les_difficulty' => ['required'],
            ],
            [
                'les_difficulty' => 'Lesson difficulty required'
            ]
        );

        Lesson::where('les_id', $id)->update([
            'les_name' => $request->les_name,
            'les_desc' => $request->les_desc,
            'les_difficulty' => $request->les_difficulty,
        ]);
    }

    // Deleting lesson by id
    public function deleteLesson($id)
    {
        $lesson = Lesson::find($id);
        $lesson->delete();
    }
}
