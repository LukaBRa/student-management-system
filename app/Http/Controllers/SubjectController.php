<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    
    public function getSubjects($user_id) {

        $subjects = User::firstWhere('id', $user_id)->professorsSubjects()->get();

        return response()->json($subjects);
    }

}
