<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_title'=> $this->faker->jobTitle(),
            'salary' => $this->faker->numberBetween(5000, 50000),
            'hire_date'  => $this->faker->date('Y-m-d', 'now')
        ];
    }
}
