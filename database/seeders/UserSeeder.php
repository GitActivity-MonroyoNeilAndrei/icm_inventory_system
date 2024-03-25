<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        User::create([
            'first_name' => 'Neil Andrei',
            'last_name' => 'Monroyo',
            'email' => 'andreimonroyo0@gmail.com',
            'position' => 'Assistant Head',
            'department' => 'Systems Support',
            'role' => 'admin',
            'center' => 'Informatics College Manila',
            'password' => 'icmadmin1993'
        ]);
    }
}
