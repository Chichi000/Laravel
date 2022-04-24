<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\service>
 */
class serviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "service_name" => $this->faker->name,
            "cost" => $this->faker->randomFloat(1, 0, 2000),
            "images" => $this->faker->image(
                "public/pictures/services",
                750,
                750,
                null,
                false
            ),
        ];
    }
}
