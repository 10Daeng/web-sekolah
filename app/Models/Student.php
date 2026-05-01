<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'class_id',
        'nisn',
        'nis',
        'name',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'religion',
        'address',
        'father_name',
        'mother_name',
        'parent_phone',
        'entry_date',
        'status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'entry_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function class()
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }
}
