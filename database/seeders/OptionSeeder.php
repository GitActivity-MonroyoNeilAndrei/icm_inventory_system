<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Option;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Option::create([
            'name' => 'IT Equipment',
            'category' => 'Category'
        ]);

        Option::create([
            'name' => 'Furniture',
            'category' => 'Category'
        ]);

        Option::create([
            'name' => 'Fixture',
            'category' => 'Category'
        ]);

        Option::create([
            'name' => 'Informatics Manila',
            'category' => 'Campus'
        ]);

        Option::create([
            'name' => 'Informatics Cavite',
            'category' => 'Campus'
        ]);

        Option::create([
            'name' => 'Informatics Baguio',
            'category' => 'Campus'
        ]);

        Option::create([
            'name' => 'Faculty',
            'category' => 'Department'
        ]);

        Option::create([
            'name' => 'Registrar',
            'category' => 'Department'
        ]);

        Option::create([
            'name' => 'Technical Office',
            'category' => 'Department'
        ]);

        Option::create([
            'name' => 'Instructor 1',
            'category' => 'Position'
        ]);

        Option::create([
            'name' => 'Instructor 2',
            'category' => 'Position'
        ]);

        Option::create([
            'name' => 'Instructor 3',
            'category' => 'Position'
        ]);
    }
}
