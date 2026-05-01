<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Registration extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'registration_number',
        'name',
        'email',
        'nisn',
        'nik',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'religion',
        'child_order',
        'address',
        'rt',
        'rw',
        'postal_code',
        'previous_school',
        'track',
        'father_name',
        'father_birth_place',
        'father_birth_date',
        'father_education',
        'father_job',
        'father_income',
        'father_phone',
        'mother_name',
        'mother_birth_place',
        'mother_birth_date',
        'mother_education',
        'mother_job',
        'mother_income',
        'mother_phone',
        'status',
        'notes',
        'verified_at',
        'verified_by',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'father_birth_date' => 'date',
        'mother_birth_date' => 'date',
        'verified_at' => 'datetime',
    ];

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('kk')->singleFile();
        $this->addMediaCollection('akta')->singleFile();
        $this->addMediaCollection('ijazah')->singleFile();
        $this->addMediaCollection('foto')->singleFile();
        $this->addMediaCollection('sertifikat')->singleFile();
        $this->addMediaCollection('sktm')->singleFile();
        $this->addMediaCollection('surat_pindah')->singleFile();
    }
}
