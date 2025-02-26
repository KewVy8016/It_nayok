<?php

// database/seeders/AdminSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'username' => 'itnayok',
            'email' => 'itnayok67@email.com',
            'password' => Hash::make('itnayok123'),
            'role' => 'root'
        ]);

        Student::create([
            'education_level' => 'ปวช.1',
            'male_count' => 0,
            'female_count' => 0
        ]);

        Student::create([
            'education_level' => 'ปวช.2',
            'male_count' => 0,
            'female_count' => 0
        ]);

        Student::create([
            'education_level' => 'ปวช.3',
            'male_count' => 0,
            'female_count' => 0
        ]);

        Student::create([
            'education_level' => 'ปวส.1',
            'male_count' => 0,
            'female_count' => 0
        ]);

        Student::create([
            'education_level' => 'ปวส.2',
            'male_count' => 0,
            'female_count' => 0
        ]);
    }
}