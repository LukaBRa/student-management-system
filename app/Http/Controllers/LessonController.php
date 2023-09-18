<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    
    public function addLesson(Request $request) {

        $validator = Validator::make($request->all(), [
            'subjectId' => 'required',
            'classId' => 'required',
            'lessonTitle' => 'required',
            'lessonDescription' => 'required',
            'lessonNumber' => 'required',
            'lessonDate' => 'required'
        ]);

        if($validator->fails()){
            return response()->json('error');
        }

        $lessonNumberExists = Lesson::whereDate('created_at', '=', $request->lessonDate)
                                    ->where('lesson_number', '=', $request->lessonNumber)
                                    ->count(); 

        if($lessonNumberExists > 0){
            return response()->json('lessonNumberError');
        }

        $lesson = new Lesson;

        $lesson->user_id = $request->professorId;
        $lesson->subject_id = $request->subjectId;
        $lesson->class_id = $request->classId;
        $lesson->lesson_title = $request->lessonTitle;
        $lesson->lesson_description = $request->lessonDescription;
        $lesson->lesson_number = $request->lessonNumber;
        $lesson->created_at = $request->lessonDate;
        $lesson->save();

        if(count($request->selectedStudents) > 0){
            foreach($request->selectedStudents as $student){
                $absence = new Absence;
                $absence->user_id = $student;
                $absence->lesson_id = $lesson->id;
                $absence->save();
            }
        }


        return response()->json('success');

    } 

    public function getLessons($date) {

        $carbonDate = Carbon::createFromFormat('d.m.Y', $date);

        $lessons = Lesson::whereDate('created_at', $carbonDate)->get();

        return response()->json($lessons);
    }

    public function searchDates($dateQuery) {

        $res = null;

        $dates = Lesson::selectRaw('DATE_FORMAT(created_at, "%d.%m.%Y") as formatedDate')
                            ->where('created_at', $dateQuery)
                            ->groupBy('formatedDate')
                            ->orderBy('formatedDate', 'DESC')
                            ->get();
    
    $dates->each(function ($item) {
        $formattedDate = \Carbon\Carbon::createFromFormat('d.m.Y', $item->formatedDate)->format('Y-m-d');

        $dayOfWeek = Carbon::parse($item->formatedDate)->dayOfWeek;
        
        $classes = DB::table('school_classes as SC')
        ->select('*')
        ->join('lessons as L', 'L.class_id', '=', 'SC.id')
        ->whereDate('L.created_at', '=', $formattedDate)
        ->distinct()
        ->get();

        
        switch($dayOfWeek){
            case 0:
                $item->dayOfWeek = "Subota";
                break;
            case 1:
                $item->dayOfWeek = "Ponedeljak";
                break;
            case 2:
                $item->dayOfWeek = "Utorak";
                break;
            case 3:
                $item->dayOfWeek = "Sreda";
                break;
            case 4:
                $item->dayOfWeek = "Četvrtak";
                break;
            case 5:
                $item->dayOfWeek = "Petak";
                break;
            case 6:
                $item->dayOfWeek = "Nedelja";
                break;
            default:
                break;
        }
        
        $item->classes = $classes;
    });

        if(count($dates) > 0){
            $res = $dates[0];
        }else{
            $res = [];
        }

        return response()->json($res);
    }

    public function getAllDates() {

        $groupedLessons = Lesson::selectRaw('DATE_FORMAT(created_at, "%d.%m.%Y") as formatedDate')
                            ->groupBy('formatedDate')
                            ->orderBy('formatedDate', 'DESC')
                            ->get();
    
    $groupedLessons->each(function ($item) {
        $formattedDate = \Carbon\Carbon::createFromFormat('d.m.Y', $item->formatedDate)->format('Y-m-d');

        $dayOfWeek = Carbon::parse($item->formatedDate)->dayOfWeek;
        
        $classes = DB::table('school_classes as SC')
        ->select('*')
        ->join('lessons as L', 'L.class_id', '=', 'SC.id')
        ->whereDate('L.created_at', '=', $formattedDate)
        ->distinct()
        ->get();

        
        switch($dayOfWeek){
            case 0:
                $item->dayOfWeek = "Subota";
                break;
            case 1:
                $item->dayOfWeek = "Ponedeljak";
                break;
            case 2:
                $item->dayOfWeek = "Utorak";
                break;
            case 3:
                $item->dayOfWeek = "Sreda";
                break;
            case 4:
                $item->dayOfWeek = "Četvrtak";
                break;
            case 5:
                $item->dayOfWeek = "Petak";
                break;
            case 6:
                $item->dayOfWeek = "Nedelja";
                break;
            default:
                break;
        }
        
        $item->classes = $classes;
    });

        return response()->json($groupedLessons);
    }

}
