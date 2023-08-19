<?php

use App\Http\Controllers\MarkController;
use App\Http\Controllers\StudentSubjectController;
use App\Http\Controllers\SubjectController;
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