<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Achievement extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'student_id',
        'title',
        'description',
        'level',
        'category',
        'date',
        'certificate_path',
        'photo_path',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('certificate')->singleFile();
        $this->addMediaCollection('photo')->singleFile();
    }
}
