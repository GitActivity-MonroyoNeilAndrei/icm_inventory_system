<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Item;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item' => Item::factory()->create()->id,
            'issued_to' => User::factory()->create()->id,
            'issued_by' => User::factory()->create()->id,
            'status' => $this->faker->randomElement(['assigned', 'unassigned']),
            'condition' => $this->faker->randomElement(['new', 'operational/working', 'condemn', 'for repair']),

        ];
    }
}
