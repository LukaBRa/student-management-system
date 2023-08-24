<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentSubjectController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Models\StudentSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get("/get-marks/{subject_id}/student/{student_id}", [MarkController::class, 'getMarks']);

Route::get("/get-professor-subjects/{user_id}", [SubjectController::class, 'getSubjects']);

Route::post('/add-mark', [MarkController::class, 'addMark']);

Route::post("/add-activity", [ActivityController::class, 'addActivity']);

Route::get("/get-user/{id}", [UserController::class, 'getUserName']);

Route::get("/get-class-students/{classId}", [SchoolClassController::class, 'getStudents']);

Route::get("/get-lessons/date/{date}", [LessonController::class, 'getLessons']);

Route::get("/search-professors/{queryString}", [UserController::class, 'searchProfessors']);

Route::get("/search-professors/by-subject/{subjectId}", [UserController::class, 'searchProfessorsBySubject']);

Route::get("/search-students/{queryString}", [UserController::class, 'searchStudents']);

Route::get("/search-students/by-class/{classId}", [UserController::class, 'searchStudentsByClassName']);

Route::get("/searchDates/{dateQuery}", [LessonController::class, 'searchDates']);

Route::get("/all-dates", [LessonController::class, 'getAllDates']);