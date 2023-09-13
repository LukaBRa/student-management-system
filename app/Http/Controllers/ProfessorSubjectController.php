<?php

namespace App\Http\Controllers;

use App\Models\ProfessorClass;
use App\Models\ProfessorSubject;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class ProfessorSubjectController extends Controller
{

    public function addSubject(Request $request) {

        $professor = User::firstWhere('id', $request->profId);

        $subject = Subject::firstWhere('id', $request->subject);

        $professor->professorsSubjects()->attach($subject);

        $sclasses = \App\Models\SchoolClass::whereIn('id', $request->sClasses)->get();

        foreach($sclasses as $sclass){
            $professor_class_instance = new ProfessorClass;
            $professor_class_instance->professor_id = $professor->id;
            $professor_class_instance->class_id = $sclass->id;
            $professor_class_instance->subject_id = $subject->id;
            $professor_class_instance->save();
        }

        return response()->json('success');

    }

}
