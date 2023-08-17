<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Activity;
use App\Models\Lesson;
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

    $professors = User::where('type_id', )->get();
    $subjects = Subject::all();

    return Inertia::render('Professors', [
        'professors' => $professors,
        'subjects' => $subjects
    ]);
});

Route::get('/ucenici', function () {
    return Inertia::render('Students');
});

Route::get('/dodaj-profesora', function () {

    $subjects = Subject::all();

    return Inertia::render('AddProfessor',[
        'subjects' => $subjects
    ]);
});

Route::post('/dodaj-profesora', [UserController::class, 'registerProfessor']);

Route::get('/dodaj-ucenika', function () {
    return Inertia::render('AddStudent');
});

Route::get('/dnevnik', function () {
    return Inertia::render('Lessons');
});

Route::get('/ucenik', function () {
    return Inertia::render('Student');
});

Route::get('/profesor', function () {
    return Inertia::render('Profesor');
});

require __DIR__.'/auth.php';
