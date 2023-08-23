<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id',
        'class_id',
        'lesson_title',
        'lesson_description',
    ];

}
