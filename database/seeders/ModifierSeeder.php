<?php

namespace Database\Seeders;

use App\Models\Products\Modifier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ModifierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

        for ($i = 0; $i < 5; $i++) {
            Modifier::insert(
                [
                    'modifier_code' => $faker->unique()->lexify('MOD-???????'),
                    'modifier_name' => $faker->beverageName(),
                ]
            );
        }
    }
}
