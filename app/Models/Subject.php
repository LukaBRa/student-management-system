<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    use HasFactory;

    public function professors(): BelongsToMany{
        return $this->belongsToMany(User::class, 'professor_subjects', 'subject_id', 'user_id');
    }

    public function students(): BelongsToMany{
        return $this->belongsToMany(User::class, 'student_subjects', 'subject_id', 'user_id');
    }
}
