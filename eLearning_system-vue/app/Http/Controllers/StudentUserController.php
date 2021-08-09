<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityDetails;


class StudentUserController extends Controller
{
    // Retunrs the student dashboard interface
    public function getStudentDashboardById($id)
    {
        return view('eLearning.studentDashboard');
    }

    // Function to produce statistics of individual user by using their id
    public function getStats($id)
    {
        // Total number of attempts
        $activity = count(ActivityDetails::where('student_id', $id)->get());
        // Total number of tries of all activities
        $tries = ActivityDetails::select('tries')->where('student_id', $id)->get();
        $triesTotal = 0;
        // adding the number of tries for each activitiy played
        for ($i = 0; $i < count($tries); $i++) {
            $s = $tries[$i]->tries;
            $triesTotal +=  $s;
        };
        // average score throughout all activities
        $score = ActivityDetails::select('score')->where('student_id', $id)->get();
        $scoreTotal = 0;
        // Adding the score of each individual activity that was played
        for ($i = 0; $i < count($score); $i++) {
            $s = $score[$i]->score;
            $scoreTotal +=  $s;
        };
        // Calculating average score
        $scoreAvr = $scoreTotal / count($score);
        //Average concentration level throughout all activities
        $conc = ActivityDetails::select('conc_level')->where('student_id', $id)->get();
        $concTotal = 0;
        for ($i = 0; $i < count($conc); $i++) {
            // Id concentration level was not recorded then count it as 0
            if ($conc[$i]->conc_level == 'N/A') {
                $newConc = 0;
            } else {
                $newConc = $conc[$i]->conc_level;
            }
            $s = $newConc;
            $concTotal +=  $s;
        };
        $concAvr = $concTotal / count($conc);

        // HOW MANY DIFFERENT ACTIVITIES ATTEMPTED TO        
        $diffAct = ActivityDetails::select('activiy_id')->where('student_id', $id)->distinct()->get();

        // link all the data in a list of arrays to be sent to the dashboard component
        $statistics = [
            ['TOTAL NUMBER OF DIFFERENT ACTIVITIES', count($diffAct)],
            ['TOTAL NUMBER OF ACTIVITY ATTEMPTS', $activity],
            ['TOTAL NUMBER OF TRIES', $triesTotal],

            ['AVERAGE SCORE PERCANTAGE (%)', $scoreAvr],
            ['AVERAGE CONCENTRATION LEVEL (%)', $concAvr]
        ];

        return $statistics;
    }
}
