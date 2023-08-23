<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{

    public function getStudents($id) {

        $students = User::where('class_id', $id)->get();

        return response()->json($students);
    }

}
