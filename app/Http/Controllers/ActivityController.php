<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    
    public function addActivity(Request $request) {

        $activity = new Activity;

        $activity->user_id = $request->studentId;
        $activity->lesson_id = 1;
        $activity->activity_type = $request->actType;
        $activity->comment = $request->description;

        $activity->save();

        return response()->json($activity);
    }

}
