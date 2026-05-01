<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'nip',
        'name',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'religion',
        'address',
        'phone',
        'email',
        'education',
        'position',
        'join_date',
        'is_active',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'join_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classes()
    {
        return $this->belongsToMany(Classroom::class, 'class_subject_teacher')
            ->withPivot('subject_id')
            ->withTimestamps();
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_subject_teacher')
            ->withPivot('class_id')
            ->withTimestamps();
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
