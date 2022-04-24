<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\employeeSeeder;
use Database\Seeders\customerSeeder;
use Database\Seeders\serviceSeeder;
use Database\Seeders\petSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        employeeSeeder::class,
        customerSeeder::class,
        serviceSeeder::class,
        petSeeder::class,
        ]);
    }
}
