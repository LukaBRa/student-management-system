<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lesson_id',
        'activity_type',
        'comment',
        'created_at'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y ');
    }

}
