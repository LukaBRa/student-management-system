<?php

namespace App\Http\Controllers;

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

        $subjects = DB::table('subjects as S')
        ->select('subject_name')
        ->join('professor_classes as PC', 'PC.subject_id', '=', 'S.id')
        ->where('PC.professor_id', '=', $professorId)
        ->where('PC.class_id', '=', $classId)
        ->get();

        return response()->json($subjects);
    }

}
