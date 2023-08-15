<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
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
    return Inertia::render('Administration');
})->name('dashboard')->middleware('auth');

Route::get('/profesori', function () {
    return Inertia::render('Professors');
});

Route::get('/ucenici', function () {
    return Inertia::render('Students');
});

Route::get('/dodaj-profesora', function () {
    return Inertia::render('AddProfessor');
});

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
