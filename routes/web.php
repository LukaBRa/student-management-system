<?php

use App\Models\User;
use Illuminate\Support\Facades\Date;
use Inertia\Inertia;
use App\Models\Lesson;
use App\Models\Absence;
use App\Models\Subject;
use App\Models\Activity;
use App\Models\SchoolClass;
use App\Models\StudentParent;
use App\Models\StudentSubject;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Models\Mark;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {

    if(Auth::check()){
        if(Auth::user()->type_id == 1 || Auth::user()->type_id == 2){
            return redirect("/administracija");
        }else{
            return redirect("/pocetna");
        }
    }

    return Inertia::render('Login');
})->name('login');

Route::post('/login', [LoginController::class, 'loginAuthentification']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get("/administracija", function () {

    $numberOfStudents = User::where('type_id', 4)->count();
    $numberOfProfessors = User::where('type_id', 2)->count();
    $lessons = Lesson::all();
    $activities = Activity::all();
    $lessonGroups = Lesson::selectRaw("lesson_description,count(id) as count")
                        ->groupBy('lesson_description')
                        ->get()
                        ->toArray();
                        $a1 = array_column($lessonGroups, 'lesson_description');
                        $a2 = array_column($lessonGroups, 'count');
                        $result= [];
                               foreach($a1 as $k => $v) {
                                   $result[] = [$v, $a2[$k]];
                               }

    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    return Inertia::render('Administration', [
        'user' => Auth::user(),
        'numberOfStudents' => $numberOfStudents,
        'numberOfProfessors' => $numberOfProfessors,
        'lessons' => $lessons,
        'activities' => $activities,
        'lessonGroups' => $result
    ]);
})->name('dashboard')->middleware('auth');

Route::get("/pocetna", function() {

    $user = Auth::user();
    $studentID = StudentParent::firstWhere('parent_id', $user->id);
    $student = User::firstWhere('id', $studentID->student_id);
    $studentsSubjects = $student->studentsSubjects()->get();
    $studentClass = SchoolClass::firstWhere('id', $student->class_id);
    $numberOfAbsences = Absence::where('user_id', $student->id)->count();
    $activities = Activity::where('user_id', $student->id)->get();
    $parents = $student->parents()->get();
    $finalMarks = StudentSubject::where('user_id', $student->id)->get();
    $temp = User::firstWhere('id', $user->id);
    $professorsSubjects = $temp->professorsSubjects()->get();
    $finalMarksConfirmed = StudentSubject::where('user_id', $student->id)
                                        ->where('final_mark', "<>" , null)
                                        ->pluck('final_mark')
                                        ->toArray();
    $finalScore = 0;

    if(count($finalMarksConfirmed) > 0){
        $sum = 0;
        foreach($finalMarksConfirmed as $mark){
            $sum += $mark;
        }
        $finalScore = $sum / count($finalMarksConfirmed);
    }

    return Inertia::render('Home', [
        'student' => $student, 
        'user' => $user,
        'subjects' => $studentsSubjects,
        'studentClass' => $studentClass,
        'numberOfAbsences' => $numberOfAbsences,
        'activities' => $activities,
        'parents' => $parents,
        'finalMarks' => $finalMarks,
        'professorsSubjects' => $professorsSubjects,
        'finalScore' => $finalScore,
    ]);

})->middleware('auth');

Route::get('/profesori', function () {

    $professors = User::where('type_id', 2)->get();
    $subjects = Subject::all();
    $user = Auth::user();

    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    return Inertia::render('Professors', [
        'professors' => $professors,
        'subjects' => $subjects,
        'user' => $user
    ]);
})->middleware('auth');

Route::get('/ucenici', function () {

    $students = User::where('type_id', 4)->get();
    $classes = SchoolClass::all();
    $user = Auth::user();

    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    return Inertia::render('Students', [
        'students' => $students,
        'classes' => $classes,
        'user' => $user
    ]);
})->middleware('auth');

Route::get('/dodaj-profesora', function () {

    $subjects = Subject::all();

    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    $user = Auth::user();

    return Inertia::render('AddProfessor',[
        'user' => $user,
        'subjects' => $subjects
    ]);
})->middleware('auth');

Route::post('/dodaj-profesora', [UserController::class, 'registerProfessor']);

Route::get('/dodaj-ucenika', function () {

    $classes = SchoolClass::all();

    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    $user = Auth::user();

    return Inertia::render('AddStudent', [
        'user' => $user,
        'classes' => $classes,
    ]);
})->middleware('auth');

Route::post('/dodaj-studenta', [UserController::class, 'registerStudent']);

Route::get('/dnevnik', function () {

    $user = Auth::user();
    $groupedLessons = Lesson::selectRaw('DATE_FORMAT(created_at, "%d.%m.%Y") as formatedDate')
                            ->groupBy('formatedDate')
                            ->orderBy('formatedDate', 'DESC')
                            ->get();

    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    return Inertia::render('Lessons', [
        'user' => $user,
        'groupedLessons' => $groupedLessons
    ]);
})->middleware('auth');

Route::get('/ucenik/{id}', function ($id) {

    $student = User::firstWhere('id', $id);
    $user = Auth::user();
    $studentsSubjects = $student->studentsSubjects()->get();
    $studentClass = SchoolClass::firstWhere('id', $student->class_id);
    $numberOfAbsences = Absence::where('user_id', $student->id)->count();
    $activities = Activity::where('user_id', $student->id)->get();
    $parents = $student->parents()->get();
    $finalMarks = StudentSubject::where('user_id', $id)->get();
    $temp = User::firstWhere('id', $user->id);
    $professorsSubjects = $temp->professorsSubjects()->get();
    $finalMarksConfirmed = StudentSubject::where('user_id', $id)
                                        ->where('final_mark', "<>" , null)
                                        ->pluck('final_mark')
                                        ->toArray();
    $finalScore = 0;

    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    if(count($finalMarksConfirmed) > 0){
        $sum = 0;
        foreach($finalMarksConfirmed as $mark){
            $sum += $mark;
        }
        $finalScore = $sum / count($finalMarksConfirmed);
    }

    return Inertia::render('Student', [
        'student' => $student, 
        'user' => $user,
        'subjects' => $studentsSubjects,
        'studentClass' => $studentClass,
        'numberOfAbsences' => $numberOfAbsences,
        'activities' => $activities,
        'parents' => $parents,
        'finalMarks' => $finalMarks,
        'professorsSubjects' => $professorsSubjects,
        'finalScore' => $finalScore,
    ]);
})->middleware('auth');

Route::get('/profesor/{id}', function ($id) {

    $professor = User::firstWhere('id', $id);
    $professorSubjects = $professor->professorsSubjects()->get();
    $user = Auth::user();
    $subjects = Subject::all();

    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    return Inertia::render('Profesor',[
        'professor' => $professor,
        'professorSubjects' => $professorSubjects,
        'allSubjects' => $subjects,
        'user' => $user
    ]);
})->middleware('auth');

Route::get('/upis-casova', function () {

    $professor = Auth::user();
    $user = User::firstWhere('id', $professor->id);
    $subjects = $user->professorsSubjects()->get();
    $classes = SchoolClass::all();

    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    return Inertia::render('AddLesson', [
        'user' => $user,
        'subjects' => $subjects,
        'classes' => $classes,
    ]);
})->middleware('auth');

Route::post("/add-lesson", [LessonController::class, 'addLesson']);

Route::get("/cas/{id}", function (string $id) {

    $lesson = Lesson::firstWhere('id', $id);
    $professor = User::firstWhere('id', $lesson->user_id);
    $subject = Subject::firstWhere('id', $lesson->subject_id);
    $absences = Absence::select('user_id')->where('lesson_id', $lesson->id)->get();
    $absentStudents = User::whereIn('id', $absences)->get();
    $sclass = SchoolClass::firstWhere('id', $lesson->class_id);
    $className = $sclass->class_name;

    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    $user = Auth::user();

    return Inertia::render('LessonOverview', [
        'user' => $user,
        'lesson' => $lesson,
        'professor' => $professor,
        'subject' => $subject,
        'absentStudents' => $absentStudents,
        'className' => $className,
    ]);
})->middleware('auth');

Route::get("/nalog", function() {

    $user = Auth::user();

    return Inertia::render('Account', [
        'user' => $user
    ]);
})->middleware('auth');

Route::post("/change-password", [UserController::class, 'changePassword']); */

require __DIR__.'/auth.php';

Route::get('/', function () {

    if(Auth::check()){
        if(Auth::user()->type_id == 1 || Auth::user()->type_id == 2){
            return redirect("/administracija");
        }else{
            return redirect("/pocetna");
        }
    }

    return Inertia::render('Login');
})->name('login');

Route::post('/login', [LoginController::class, 'loginAuthentification']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get("/administracija", function () {

    $numberOfStudents = User::where('type_id', 4)->count();
    $numberOfProfessors = User::where('type_id', 2)->count();
    $lessons = Lesson::all();
    $activities = $activities = DB::table('activities as A')
    ->select('*')
    ->join('lessons as L', 'L.id', '=', 'A.lesson_id')
    ->orderBy('L.created_at', 'desc')
    ->get();
    $lessonGroups = Lesson::selectRaw("lesson_description,count(id) as count")
                        ->groupBy('lesson_description')
                        ->get()
                        ->toArray();
                        $a1 = array_column($lessonGroups, 'lesson_description');
                        $a2 = array_column($lessonGroups, 'count');
                        $result= [];
                               foreach($a1 as $k => $v) {
                                   $result[] = [$v, $a2[$k]];
                               }

                               $activities->each(function($item) {

                                $professor = DB::table('users')
                                            ->where('id', function($query) use ($item) {
                                                $query->select('user_id')
                                                ->from('lessons')
                                                ->where('id', $item->lesson_id)
                                                ->first();
                                            })
                                            ->first();
                        
                                $subject = DB::table('subjects')
                                            ->where('id', function($query) use ($item) {
                                                $query->select('subject_id')
                                                ->from('lessons')
                                                ->where('id', $item->lesson_id)
                                                ->first();
                                            })
                                            ->first();
                        
                                $lesson = Lesson::selectRaw('DATE_FORMAT(created_at, "%d.%m.%Y") as formatedDate')
                                                    ->where('id', '=', $item->lesson_id)->first();
                                $lessonDate = $lesson->formatedDate;
                                $dayOfWeek = Carbon::parse($lessonDate)->dayOfWeek;
                        
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
                                $item->lessonDate = $lessonDate;
                                $item->professorName = $professor->name;
                                $item->subjectName = $subject->subject_name;
                        
                            });

    $activities->sortByDesc('lessonDate');

    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    return Inertia::render('Administration', [
        'user' => Auth::user(),
        'numberOfStudents' => $numberOfStudents,
        'numberOfProfessors' => $numberOfProfessors,
        'lessons' => $lessons,
        'activities' => $activities,
        'lessonGroups' => $result
    ]);
})->name('dashboard')->middleware('auth');

Route::get("/pocetna", function() {

    $user = Auth::user();
    $studentID = StudentParent::firstWhere('parent_id', $user->id);
    $student = User::firstWhere('id', $studentID->student_id);
    $studentsSubjects = $student->studentsSubjects()->get();
    $studentClass = SchoolClass::firstWhere('id', $student->class_id);
    $numberOfAbsences = Absence::where('user_id', $student->id)->count();
    $activities = $activities = DB::table('activities as A')
    ->select('*')
    ->join('lessons as L', 'L.id', '=', 'A.lesson_id')
    ->orderBy('L.created_at', 'desc')
    ->get();
    $parents = $student->parents()->get();
    $finalMarks = StudentSubject::where('user_id', $student->id)->get();
    $temp = User::firstWhere('id', $user->id);
    $professorsSubjects = $temp->professorsSubjects()->get();
    $finalMarksConfirmed = StudentSubject::where('user_id', $student->id)
                                        ->where('final_mark', "<>" , null)
                                        ->pluck('final_mark')
                                        ->toArray();
    $finalScore = 0;

    $studentsSubjects->each(function($subj) use ($student){
        $marks = Mark::where('user_id', $student->id)
                    ->where('subject_id', $subj->id)
                    ->get();
        $averageMark = Mark::where('user_id', $student->id)
        ->where('subject_id', $subj->id)
        ->avg('mark');

        $finalMarkTemp = StudentSubject::where('user_id', $student->id)
                                        ->where('subject_id', $subj->id)
                                        ->first();
        
        $subj->finalMark = $finalMarkTemp->final_mark;
        $subj->marks = $marks;
        $subj->avgMark = round($averageMark, 2);
    });

    if(count($finalMarksConfirmed) > 0){
        $sum = 0;
        foreach($finalMarksConfirmed as $mark){
            $sum += $mark;
        }
        $finalScore = $sum / count($finalMarksConfirmed);
    }

    $activities->each(function($item) {

        $professor = DB::table('users')
                    ->where('id', function($query) use ($item) {
                        $query->select('user_id')
                        ->from('lessons')
                        ->where('id', $item->lesson_id)
                        ->first();
                    })
                    ->first();

        $subject = DB::table('subjects')
                    ->where('id', function($query) use ($item) {
                        $query->select('subject_id')
                        ->from('lessons')
                        ->where('id', $item->lesson_id)
                        ->first();
                    })
                    ->first();

        $lesson = Lesson::selectRaw('DATE_FORMAT(created_at, "%d.%m.%Y") as formatedDate')
                            ->where('id', '=', $item->lesson_id)->first();
        $lessonDate = $lesson->formatedDate;
        $dayOfWeek = Carbon::parse($lessonDate)->dayOfWeek;

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
        $item->lessonDate = $lessonDate;
        $item->professorName = $professor->name;
        $item->subjectName = $subject->subject_name;

    });

    return Inertia::render('Home', [
        'student' => $student, 
        'user' => $user,
        'subjects' => $studentsSubjects,
        'studentClass' => $studentClass,
        'numberOfAbsences' => $numberOfAbsences,
        'activities' => $activities,
        'parents' => $parents,
        'finalMarks' => $finalMarks,
        'professorsSubjects' => $professorsSubjects,
        'finalScore' => $finalScore,
    ]);

})->middleware('auth');

Route::get('/profesori', function () {

    $professors = User::where('type_id', 2)->get();
    $subjects = Subject::all();
    $user = Auth::user();

    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    return Inertia::render('Professors', [
        'professors' => $professors,
        'subjects' => $subjects,
        'user' => $user
    ]);
})->middleware('auth');

Route::get('/ucenici', function () {

    $students = User::where('type_id', 4)->get();
    $classes = SchoolClass::all();
    $user = Auth::user();
    $profClasses = [];
    if(Auth::user()->type_id == 2) {

        $profClasses = DB::table('school_classes as SC')
        ->select('SC.id')
        ->join('professor_classes as PC', 'PC.class_id', '=', 'SC.id')
        ->where('PC.professor_id', '=', $user->id)
        ->groupBy('SC.id')
        ->get();

        $profClasses->each(function ($item) {

            $tempSubjects = DB::table('subjects as S')
            ->select('subject_name')
            ->join('professor_classes as PC', 'PC.subject_id', 'S.id')
            ->where('PC.class_id', '=', $item->id)
            ->where('PC.professor_id', '=', Auth::user()->id)
            ->get();

            $tempStudents = User::where('class_id', $item->id)->get();

            $tempClass = DB::table('school_classes as SC')
            ->select('*')
            ->where('id', '=', $item->id)
            ->get();

            $item->pClass = $tempClass[0]; 
            $item->subjects = $tempSubjects;
            $item->students = $tempStudents;

        });

    }

    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    return Inertia::render('Students', [
        'students' => $students,
        'classes' => $classes,
        'user' => $user,
        'profClasses' => $profClasses
    ]);
})->middleware('auth');

Route::get('/dodaj-profesora', function () {

    $subjects = Subject::all();
    $classes = SchoolClass::all();

    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    $user = Auth::user();

    return Inertia::render('AddProfessor',[
        'user' => $user,
        'subjects' => $subjects,
        'classes' => $classes,
    ]);
})->middleware('auth');

Route::post('/dodaj-profesora', [UserController::class, 'registerProfessor']);

Route::get('/dodaj-ucenika', function () {

    $classes = SchoolClass::all();

    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    $user = Auth::user();

    return Inertia::render('AddStudent', [
        'user' => $user,
        'classes' => $classes,
    ]);
})->middleware('auth');

Route::post('/dodaj-studenta', [UserController::class, 'registerStudent']);

Route::get('/dnevnik', function () {

    $user = Auth::user();
    $groupedLessons = Lesson::selectRaw('DATE_FORMAT(created_at, "%d.%m.%Y") as formatedDate')
                            ->groupBy('formatedDate')
                            ->orderBy('formatedDate', 'DESC')
                            ->get();
    
    $groupedLessons->each(function ($item) {
        $formattedDate = \Carbon\Carbon::createFromFormat('d.m.Y', $item->formatedDate)->format('Y-m-d');

        $dayOfWeek = Carbon::parse($item->formatedDate)->dayOfWeek;

        $classes = DB::table('school_classes')
                ->select('*')
                ->whereIn('id', function($query) use ($formattedDate){
                    $query->select('class_id')
                    ->from('lessons')
                    ->whereDate('created_at', '=', $formattedDate)
                    ->get();
                })
                ->get();

        $classes->each(function($tempClass) use ($formattedDate){

            $classLessons = Lesson::where('class_id', '=', $tempClass->id)
                                    ->whereDate('created_at', '=', $formattedDate)
                                    ->orderBy('lesson_number')
                                    ->get();
            
            $classLessons->each(function ($tmpLesson) {
                
                $subject = Subject::where('id', function($query) use ($tmpLesson){
                    $query->select('subject_id')
                    ->from('lessons')
                    ->where('id', $tmpLesson->id)
                    ->first();
                })->first();

                $tmpLesson->subject_name = $subject->subject_name;

            });

            $tempClass->classLessons = $classLessons;

        });

        
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


    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    return Inertia::render('Lessons', [
        'user' => $user,
        'groupedLessons' => $groupedLessons
    ]);
})->middleware('auth');

Route::get('/ucenik/{id}', function ($id) {

    $student = User::where('id', $id)->first();
    $user = Auth::user();
    $studentsSubjects = null;
    $studentClass = SchoolClass::firstWhere('id', $student->class_id);
    $numberOfAbsences = Absence::where('user_id', $student->id)->count();
    $activities = DB::table('activities as A')
                    ->select('*')
                    ->join('lessons as L', 'L.id', '=', 'A.lesson_id')
                    ->orderBy('L.created_at', 'desc')
                    ->get();
    $parents = $student->parents()->get();
    $finalMarks = StudentSubject::where('user_id', $id)->get();
    $temp = User::firstWhere('id', $user->id);
    $professorLessons = [];
    $professorsSubjects = $temp->professorsSubjects()->get();
    $finalMarksConfirmed = StudentSubject::where('user_id', $id)
                                        ->where('final_mark', "<>" , null)
                                        ->pluck('final_mark')
                                        ->toArray();
    $finalScore = 0;

    $activities->each(function($item) {

        $professor = DB::table('users')
                    ->where('id', function($query) use ($item) {
                        $query->select('user_id')
                        ->from('lessons')
                        ->where('id', $item->lesson_id)
                        ->first();
                    })
                    ->first();

        $subject = DB::table('subjects')
                    ->where('id', function($query) use ($item) {
                        $query->select('subject_id')
                        ->from('lessons')
                        ->where('id', $item->lesson_id)
                        ->first();
                    })
                    ->first();

        $lesson = Lesson::selectRaw('DATE_FORMAT(created_at, "%d.%m.%Y") as formatedDate')
                            ->where('id', '=', $item->lesson_id)->first();
        $lessonDate = $lesson->formatedDate;
        $dayOfWeek = Carbon::parse($lessonDate)->dayOfWeek;

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
        $item->lessonDate = $lessonDate;
        $item->professorName = $professor->name;
        $item->subjectName = $subject->subject_name;

    });


    if(Auth::user()->type_id == 2){
        $studentsSubjects = DB::table('subjects as S')
        ->select('*')
        ->join('professor_classes as PC', 'PC.subject_id', '=', 'S.id')
        ->where('PC.professor_id', '=', $user->id)
        ->where('PC.class_id', '=', $student->class_id)
        ->get();

        $professorLessons = Lesson::where('user_id', Auth::user()->id)->get();

        $professorLessons->each(function($item) {

            $subjectName = Subject::where('id', $item->subject_id)->first();
            $dayOfWeek = Carbon::parse($item->created_at)->dayOfWeek;
            $formatedDate = Lesson::selectRaw('DATE_FORMAT(created_at, "%d.%m.%Y") as formatedDate')
                            ->where('id', $item->id)
                            ->first();
        
            $item->subjectName = $subjectName->subject_name;
            switch($dayOfWeek){
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
                    $item->dayOfWeek = "Subota";
                    break;
                case 7:
                    $item->dayOfWeek = "Nedelja";
                    break;
                default:
                    break;
            }
            $item->formatedDate = $formatedDate->formatedDate; 

        });

    }else{
        $studentsSubjects = $student->studentsSubjects()->get();
    }

    $studentsSubjects->each(function($subj) use ($student){
        $marks = Mark::where('user_id', $student->id)
                    ->where('subject_id', $subj->id)
                    ->get();
        $averageMark = Mark::where('user_id', $student->id)
        ->where('subject_id', $subj->id)
        ->avg('mark');

        $finalMarkTemp = StudentSubject::where('user_id', $student->id)
                                        ->where('subject_id', $subj->id)
                                        ->first();
        
        $subj->finalMark = $finalMarkTemp->final_mark;
        $subj->marks = $marks;
        $subj->avgMark = round($averageMark, 2);
    });

    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    if(count($finalMarksConfirmed) > 0){
        $sum = 0;
        foreach($finalMarksConfirmed as $mark){
            $sum += $mark;
        }
        $finalScore = $sum / count($finalMarksConfirmed);
    }

    return Inertia::render('Student', [
        'student' => $student, 
        'user' => $user,
        'subjects' => $studentsSubjects,
        'studentClass' => $studentClass,
        'numberOfAbsences' => $numberOfAbsences,
        'activities' => $activities,
        'parents' => $parents,
        'finalMarks' => $finalMarks,
        'professorsSubjects' => $professorsSubjects,
        'finalScore' => $finalScore,
        'professorLessons' => $professorLessons,
    ]);
})->middleware('auth');

Route::get('/profesor/{id}', function ($id) {

    $professor = User::firstWhere('id', $id);
    $professorSubjects = $professor->professorsSubjects()->get();
    $user = Auth::user();
    $subjects = Subject::all();
    $prClassesSubjects = DB::table('professor_classes as PC')
    ->select('PC.professor_id', 'SC.class_name', 'PC.subject_id')
    ->join('users as U', 'U.id', '=', 'PC.professor_id')
    ->join('subjects as S', 'S.id', '=', 'PC.subject_id')
    ->join('school_classes as SC', 'SC.id', '=', 'PC.class_id')
    ->where('U.id', '=', $professor->id)
    ->get();
    $allClasses = SchoolClass::all();

    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    return Inertia::render('Profesor',[
        'professor' => $professor,
        'professorSubjects' => $professorSubjects,
        'allSubjects' => $subjects,
        'user' => $user,
        'prClassesSubjects' => $prClassesSubjects,
        'allClasses' => $allClasses,
    ]);
})->middleware('auth');

Route::get('/upis-casova', function () {

    $professor = Auth::user();
    $classes = DB::table('school_classes')
    ->select('*')
    ->distinct()
    ->whereIn('id', function($query) {
        $query->select('class_id')
        ->from('professor_classes')
        ->where('professor_id', '=', Auth::user()->id)
        ->get();
    })
    ->get();

    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    return Inertia::render('AddLesson', [
        'user' => $professor,
        'classes' => $classes,
    ]);
})->middleware('auth');

Route::post("/dodaj-cas", [LessonController::class, 'addLesson']);

Route::post("/add-lesson", [LessonController::class, 'addLesson']);

Route::get("/cas/{id}", function (string $id) {

    $lesson = Lesson::firstWhere('id', $id);
    $professor = User::firstWhere('id', $lesson->user_id);
    $subject = Subject::firstWhere('id', $lesson->subject_id);
    $absences = Absence::select('user_id')->where('lesson_id', $lesson->id)->get();
    $absentStudents = User::whereIn('id', $absences)->get();
    $sclass = SchoolClass::firstWhere('id', $lesson->class_id);
    $className = $sclass->class_name;
    $activities = Activity::where('lesson_id', $id)->get();

    $activities->each(function($item) {

        $professor = DB::table('users')
                    ->where('id', function($query) use ($item) {
                        $query->select('user_id')
                        ->from('lessons')
                        ->where('id', $item->lesson_id)
                        ->first();
                    })
                    ->first();

        $subject = DB::table('subjects')
                    ->where('id', function($query) use ($item) {
                        $query->select('subject_id')
                        ->from('lessons')
                        ->where('id', $item->lesson_id)
                        ->first();
                    })
                    ->first();

        $student = User::firstWhere('id', $item->user_id);

        $lesson = Lesson::selectRaw('DATE_FORMAT(created_at, "%d.%m.%Y") as formatedDate')
                            ->where('id', '=', $item->lesson_id)->first();
        $lessonDate = $lesson->formatedDate;
        $dayOfWeek = Carbon::parse($lessonDate)->dayOfWeek;

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
        $item->student = $student;
        $item->lessonDate = $lessonDate;
        $item->professorName = $professor->name;
        $item->subjectName = $subject->subject_name;

    });

    if(Auth::user()->type_id == 3){
        return redirect("/pocetna");
    }

    $user = Auth::user();

    return Inertia::render('LessonOverview', [
        'user' => $user,
        'lesson' => $lesson,
        'professor' => $professor,
        'subject' => $subject,
        'absentStudents' => $absentStudents,
        'className' => $className,
        'activities' => $activities,
    ]);
})->middleware('auth');

Route::get("/nalog", function() {

    $user = Auth::user();

    return Inertia::render('Account', [
        'user' => $user
    ]);
})->middleware('auth');

Route::post("/izmeni-lozinku", [UserController::class, 'changePassword']);