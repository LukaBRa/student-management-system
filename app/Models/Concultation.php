<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'professor_id',
        'consultation_appointment',
        'room_name'
    ];
}
