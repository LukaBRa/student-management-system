<?php

namespace App\Http\Controllers;

use App\Models\ProfessorSubject;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class ProfessorSubjectController extends Controller
{

    public function addSubject(Request $request) {

        $professor = User::firstWhere('id', $request->profId);

        $subjects = Subject::whereIn('id', $request->subjects)->get();

        foreach($subjects as $subject) {
            $professor->professorsSubjects()->attach($subject);
        }

        return response()->json('success');

    }

}
