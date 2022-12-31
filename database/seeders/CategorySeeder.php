<?php

namespace Database\Seeders;

use App\Models\Products\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 5; $i++) {
            Category::insert(
                [
                    'category_code' => $faker->unique()->lexify('CAT-???????'),
                    'category_name' => $faker->word(),
                    'isModifier'    => $faker->randomElement([0, 1]),
                    'created_at'    => now()->toDateTimeString(),
                    'updated_at'    => now()->toDateTimeString(),
                ]
            );
        }
    }
}
