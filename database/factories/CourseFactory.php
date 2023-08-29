<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $vendor = Vendor::pluck('id')->toArray();
        $category = Category::pluck('id')->toArray();
        $user = User::pluck('id')->toArray();
        return [
            'name' => $this->faker->word(),
            'hours' => $this->faker->numberBetween(25,80),
            'price' => $this->faker->numberBetween(800,8000),
            'vendor_id' =>$this->faker->randomElement($vendor),
            'category_id' => $this->faker->randomElement($category),
            'user_id' => $this->faker->randomElement($user)

        ];
    }
}
