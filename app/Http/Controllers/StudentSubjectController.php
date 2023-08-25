<?php

namespace App\Http\Controllers;

use App\Models\StudentSubject;
use Illuminate\Http\Request;

class StudentSubjectController extends Controller
{
    
    public function getFinalMark($subject_id, $student_id) {

        $finalMark = StudentSubject::where('user_id', $student_id)
                                    ->where('subject_id', $subject_id)
                                    ->value('final_mark');

        if($finalMark == null){
            $finalMark = "Nije zaključena ocena";
        }

        return response()->json($finalMark);

    }

    public function confirmMark(Request $request) {

        $record = StudentSubject::where('user_id', $request->studentId)
                                ->where('subject_id', $request->subjectId)
                                ->firstOrFail();

        $record->final_mark = $request->finalMark;
        $record->save();

        return response()->json("success");
    }

}
