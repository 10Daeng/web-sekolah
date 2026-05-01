<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@sist.test',
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);
        $superAdmin->assignRole('super_admin');

        $adminTu = User::create([
            'name' => 'Admin TU',
            'email' => 'tu@sist.test',
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);
        $adminTu->assignRole('admin_tu');
    }
}
