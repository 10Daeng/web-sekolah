<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            'Pendidikan Agama',
            'PKn',
            'Bahasa Indonesia',
            'Matematika',
            'IPA',
            'IPS',
            'SBdP',
            'PJOK',
        ];

        foreach ($subjects as $subject) {
            Subject::firstOrCreate(['name' => $subject]);
        }
    }
}
