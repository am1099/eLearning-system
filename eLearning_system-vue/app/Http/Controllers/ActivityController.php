<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Lesson;
use App\Models\Activity;
use App\Models\ActivityDetails;



class ActivityController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Gets activity by id, using lesson id
    public function viewActivity($id)
    {
        $activity = Activity::where('act_id', $id)->get();
        $lessonId = Activity::where('act_id', $id)->value('lesson_id');
        $lesson = Lesson::where('les_id', $lessonId)->get();

        return view('activityView', compact('activity', 'lesson'));
    }

    // creates new activity
    public function createActivity(Request $request, $id)
    {
        $lesson = Lesson::select('program_id')->where('les_id', $id)->first();

        // validating all important inputs
        $this->validate(
            $request,
            [
                // check that activity name is unique within the lessons table
                'act_name' => [
                    'required', 'string', 'max:255',
                    'unique:units,unit_name' => Rule::unique('activities')->where('act_id', $id)
                ],
                'act_desc' => ['required', 'string', 'max:300'],
                'act_difficulty' => ['required'],
                'correct_answer' => ['required'],
                'act_question' => ['required'],
                'act_min_keystrokes' => ['required', 'integer']
            ],
            [
                'act_name.unique' => 'Activity name already used within this Unit',
                'act_difficulty' => 'Activity difficulty required',
                'correct_answer' => 'Activity correct answer required'
            ]
        );

        $user_id = Auth::user()->u_id;

        // Get Script file and filename
        $scriptContents = $request->act_script;
        var_dump($scriptContents);

        // Get Image file and filename
        $imageContents = $request->act_images;
        var_dump($imageContents);


        // create new activity
        $activity = new Activity;
        $activity->act_name = $request->act_name;
        $activity->act_desc = $request->act_desc;
        $activity->act_difficulty = $request->act_difficulty;
        $activity->correct_answer = $request->correct_answer;
        $activity->act_question = $request->act_question;

        //if script does not exist store null otherwise file name
        if ($scriptContents == 'e') {
            $activity->act_script = null;
        } else {
            $scriptFilename = $scriptContents->getClientOriginalName();

            $activity->act_script = $scriptFilename;
        }

        //if image does not exist store null otherwise file name
        if ($scriptContents == 'e') {
            $activity->act_images = null;
        } else {
            $imageFilename = $imageContents->getClientOriginalName();

            $activity->act_images = $imageFilename;
        }
        $activity->act_min_keystrokes = $request->act_min_keystrokes;

        $activity->validated = false;
        $activity->created_by_id = $user_id;
        $activity->lesson_id = $id;
        $activity->program_id = $lesson->program_id;

        $activity->save();

        // if there are files then create their respective folders
        if ($scriptContents !== 'e') {
            // Upload files in their respective directories
            $scriptContents->move(public_path('Activities/P' . $lesson->program_id . 'L' . $id . 'A' . $activity->act_id . '/scripts'), $scriptFilename);
            $imageContents->move(public_path('Activities/P' . $lesson->program_id . 'L' . $id .  'A' . $activity->act_id . '/images'), $imageFilename);
        }
    }

    // updating activity by id
    public function updateActivity(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'act_desc' => ['required', 'string', 'max:300'],
                'act_difficulty' => ['required'],
                'correct_answer' => ['required'],
                'act_question' => ['required'],

                'act_min_keystrokes' => ['required', 'integer']
            ],
            [
                'act_difficulty' => 'Activity difficulty required',
                'correct_answer' => 'Activity correct answer required'
            ]
        );

        Activity::where('act_id', $id)->update([
            'act_name' => $request->act_name,
            'act_desc' => $request->act_desc,
            'act_difficulty' => $request->act_difficulty,
            'correct_answer' => $request->correct_answer,
            'act_question' => $request->act_question,
            'act_min_keystrokes' => $request->act_min_keystrokes,
        ]);
    }

    //Deleting activity by id
    public function deleteActivity($id)
    {
        $activity = Activity::find($id);
        $activity->delete();
    }

    // storing activity details to activity details table
    public function updatingActivityScore(Request $request, $id)
    {

        // if concentration level was not recorded then store 'n/a'
        if ($request->conc_level == null) {
            $conc_level = 'N/A';
        } else {
            $conc_level = $request->conc_level;
        }

        $activityDetails = new ActivityDetails;
        $activityDetails->score = $request->score;
        $activityDetails->tries = $request->tries;
        $activityDetails->time_to_complete = 0;
        $activityDetails->keystrokes_recorded = $request->keystrokes_recorded;
        $activityDetails->keystroke_rate = 25;
        $activityDetails->conc_level = $conc_level;
        $activityDetails->activiy_id = $id;
        $activityDetails->student_id = 1;

        $activityDetails->save();
    }
}
