<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            AcademicYearSeeder::class,
            SubjectSeeder::class,
        ]);

        // Create default settings if none exist
        \App\Models\Setting::firstOrCreate(
            ['key' => 'nama'],
            ['value' => config('app.sekolah.nama', 'SD Negeri Contoh'), 'group' => 'general', 'type' => 'string']
        );
        \App\Models\Setting::firstOrCreate(
            ['key' => 'tahun_berdiri'],
            ['value' => config('app.sekolah.tahun_berdiri', 1985), 'group' => 'general', 'type' => 'string']
        );
        \App\Models\Setting::firstOrCreate(
            ['key' => 'akreditasi'],
            ['value' => config('app.sekolah.akreditasi', 'A'), 'group' => 'general', 'type' => 'string']
        );
    }
}
