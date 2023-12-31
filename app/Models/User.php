<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type_id',
        'class_id',
        'name',
        'email',
        'password',
        'adress',
        'phone_number'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function professorsSubjects(): BelongsToMany {
        return $this->belongsToMany(Subject::class, 'professor_subjects', 'user_id', 'subject_id');
    }

    public function professorsClasses(): BelongsToMany {
        return $this->belongsToMany(SchoolClass::class, 'professor_classes', 'professor_id', 'class_id');
    }

    public function studentsSubjects(): BelongsToMany {
        return $this->belongsToMany(Subject::class, 'student_subjects', 'user_id', 'subject_id');
    }

    public function parents(): BelongsToMany {
        return $this->belongsToMany(User::class, 'student_parents', 'student_id', 'parent_id');
    }

    public function child(): BelongsToMany {
        return $this->belongsToMany(User::class, 'student_parents', 'parent_id', 'student_id');
    }

}
