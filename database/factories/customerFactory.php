<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\customer>
 */
class customerFactory extends Factory
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
            "cell_number" => $this->faker->numerify("###-###-####"),
            "pictures" => $this->faker->image(
                "public/pictures/customers",
                750,
                750,
                null,
                false
            ),
        ];
    }
}
