<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    
    public function addLesson(Request $request) {

        $validator = Validator::make($request->all(), [
            'subjectId' => 'required',
            'classId' => 'required',
            'lessonTitle' => 'required',
            'lessonDescription' => 'required'
        ]);

        if($validator->fails()){
            return response()->json('error');
        }

        $lesson = new Lesson;
        $lesson->user_id = $request->userId;
        $lesson->subject_id = $request->subjectId;
        $lesson->class_id = $request->classId;
        $lesson->lesson_title = $request->lessonTitle;
        $lesson->lesson_description = $request->lessonDescription;
        $lesson->save();

            foreach($request->checkedStudents as $absentStudent){
                $absence = new Absence;
                $absence->user_id = $absentStudent;
                $absence->lesson_id = $lesson->id;
                $absence->save();
            }

        return response()->json('success');

    } 

    public function getLessons($date) {

        $carbonDate = Carbon::createFromFormat('d.m.Y', $date);

        $lessons = Lesson::whereDate('created_at', $carbonDate)->get();

        return response()->json($lessons);
    }

}
