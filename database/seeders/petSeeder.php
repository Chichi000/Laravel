<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;
use Illuminate\Support\Facades\DB;
use App\Models\Pet;

class petSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $customer = DB::table('customers')->pluck('id');
        foreach (range(1, 10) as $index) {
            Pet::create([
                'customer_id' => $faker->randomElement($customer),
                'pet_name' => $faker->name(),
                'sex' => $faker->randomElement(['Male', 'Female']),
                'kind' => $faker->randomElement(['Dog', 'Cat', 'Bird']),
                "pictures" => $faker->image(
                    "public/pictures/pets",
                    640,
                    480,
                    null,
                    false
                ),
            ]);
        }
    }

}
