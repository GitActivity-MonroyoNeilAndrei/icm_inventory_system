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
            'name' => 'IT equipment',
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
    }
}
