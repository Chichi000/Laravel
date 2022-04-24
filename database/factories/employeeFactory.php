<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\employee>
 */
class employeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "full_name" => $this->faker->name,
            "email" => $this->faker->unique()->safeEmail(),
            "password" => bcrypt("Aldiya123"), //Password for ALL Dummy Employee Data
            "pictures" => $this->faker->image(
                "public/pictures/employees",
                640,
                480,
                null,
                false
            ),
        ];
    }
}
