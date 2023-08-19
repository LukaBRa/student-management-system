<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\StudentSubject;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class MarkController extends Controller
{
    
    public function getMarks($subject_id, $student_id) {

        $marksArray = Mark::where('user_id', $student_id)
                                ->where('subject_id', $subject_id)
                                ->get();
        $marks = array();
        
        foreach($marksArray as $mark){
            $marks[] = $mark->mark;
        }


        return response()->json(['marks' => $marks]);

    }

    public function addMark(Request $request) {

        $mark = new Mark;

        $mark->user_id = $request->studentId;
        $mark->subject_id = $request->subjectId;
        $mark->mark = $request->mark;
        
        $mark->save();

        return response()->json('success');
    }

}
