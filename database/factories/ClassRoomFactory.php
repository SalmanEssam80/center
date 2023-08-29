<?php

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassRoom>
 */
class ClassRoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $branch = Branch::pluck('id')->toArray();
        return [
            'name' => $this->faker->word(),
            'configration' => $this->faker->sentence(),
            'capacity' => $this->faker->numberBetween(10,20),
            'branch_id'  => $this->faker->randomElement($branch)
        ];
    }
}
