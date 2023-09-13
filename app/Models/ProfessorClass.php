<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessorClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'professor_id',
        'class_id',
        'subject_id'
    ];
}
