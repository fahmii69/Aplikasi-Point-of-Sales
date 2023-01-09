<?php

namespace Database\Seeders;

use App\Models\Products\Modifier;
use App\Models\Products\ModifierDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ModifierDetailSeeder extends Seeder
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
            ModifierDetail::insert(
                [
                    'modifier_code'       => Modifier::inRandomOrder()->first()->modifier_code,
                    'modifier_detailCode' => $faker->unique()->lexify('MDET-???????'),
                    'modifier_detailName' => $faker->sauceName(),
                    'modifier_price'       => $faker->numerify('#000'),
                ]
            );
        }
    }
}
