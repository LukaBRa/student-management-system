<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    
    public function getSubjects($user_id) {

        $subjects = User::firstWhere('id', $user_id)->professorsSubjects()->get();

        return response()->json($subjects);
    }

    public function getProfessorsSubjects($classId, $professorId) {

        $subjects = DB::table('subjects')
        ->select('*')
        ->whereIn('id', function($query) use($classId, $professorId){
            $query->select('subject_id')
            ->from('professor_classes')
            ->where('professor_id', '=', $professorId)
            ->where('class_id', '=', $classId)
            ->get();
        })
        ->get();

        return response()->json($subjects);
    }

    public function getName($id){

        $subject = Subject::where('id', $id)->get()->first();

        return response()->json($subject->subject_name);

    }

}
