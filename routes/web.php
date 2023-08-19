<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Absence;
use App\Models\Activity;
use App\Models\Lesson;
use App\Models\SchoolClass;
use App\Models\StudentSubject;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {

    if(Auth::check()){
        return redirect("/administracija");
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

    return Inertia::render('Administration', [
        'user' => Auth::user(),
        'numberOfStudents' => $numberOfStudents,
        'numberOfProfessors' => $numberOfProfessors,
        'lessons' => $lessons,
        'activities' => $activities
    ]);
})->name('dashboard')->middleware('auth');

Route::get('/profesori', function () {

    $professors = User::where('type_id', 2)->get();
    $subjects = Subject::all();
    $user = Auth::user();

    return Inertia::render('Professors', [
        'professors' => $professors,
        'subjects' => $subjects,
        'user' => $user
    ]);
});

Route::get('/ucenici', function () {

    $students = User::where('type_id', 4)->get();
    $classes = SchoolClass::all();
    $user = Auth::user();

    return Inertia::render('Students', [
        'students' => $students,
        'classes' => $classes,
        'user' => $user
    ]);
});

Route::get('/dodaj-profesora', function () {

    $subjects = Subject::all();

    return Inertia::render('AddProfessor',[
        'subjects' => $subjects
    ]);
});

Route::post('/dodaj-profesora', [UserController::class, 'registerProfessor']);

Route::get('/dodaj-ucenika', function () {

    $subjects = Subject::all();
    $classes = SchoolClass::all();

    return Inertia::render('AddStudent', [
        'subjects' => $subjects,
        'classes' => $classes,
    ]);
});

Route::post('/dodaj-studenta', [UserController::class, 'registerStudent']);

Route::get('/dnevnik', function () {
    return Inertia::render('Lessons');
});

Route::get('/ucenik/{id}', function ($id) {

    $student = User::firstWhere('id', $id);
    $user = Auth::user();
    $studentsSubjects = $student->studentsSubjects()->get();
    $studentClass = SchoolClass::firstWhere('id', $student->class_id);
    $numberOfAbsences = Absence::where('user_id', $student->id)->count();
    $activities = Activity::where('user_id', $student->id)->get();
    $parents = $student->parents()->get();
    $finalMarks = StudentSubject::where('user_id', $id)->get();
    $professorsSubjects = $user->professorsSubjects()->get();

    return Inertia::render('Student', [
        'student' => $student, 
        'user' => $user,
        'subjects' => $studentsSubjects,
        'studentClass' => $studentClass,
        'numberOfAbsences' => $numberOfAbsences,
        'activities' => $activities,
        'parents' => $parents,
        'finalMarks' => $finalMarks,
        'professorsSubjects' => $professorsSubjects
    ]);
});

Route::get('/profesor/{id}', function ($id) {

    $professor = User::firstWhere('id', $id);
    $professorSubjects = $professor->professorsSubjects()->get();
    $user = Auth::user();

    return Inertia::render('Profesor',[
        'professor' => $professor,
        'professorSubjects' => $professorSubjects,
        'user' => $user
    ]);
});

require __DIR__.'/auth.php';
