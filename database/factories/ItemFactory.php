<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'category' => $this->faker->randomElement(['category 1', 'category 2']),
            'serial_no' => $this->faker->ean13,
            'model' => $this->faker->word,
            'description' => $this->faker->text(200),
            'additional_details' => $this->faker->paragraph($nbSentences = 2, $variableNbSentences = true),
            'status' => $this->faker->randomElement(['assigned', 'unassigned']),
            'condition' => $this->faker->randomElement(['new', 'operational/working', 'condemn', 'for repair']),
            'added_by' => \App\Models\User::factory()->create()->id,
            'date_acquisition' => $this->faker->date,
            'date_added' => $this->faker->date,
        ];
    }
}
