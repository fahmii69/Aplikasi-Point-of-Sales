<?php

namespace Database\Seeders;

use App\Models\Products\Modifier;
use App\Models\Products\Product;
use App\Models\Products\ProductModifier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductModifierSeeder extends Seeder
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
            ProductModifier::insert(
                [
                    'product_modifierCode' => $faker->unique()->lexify('MPDT-???????'),
                    'product_code' => Product::inRandomOrder()->first()->product_code,
                    'modifier_code'      => Modifier::inRandomOrder()->first()->modifier_code,
                ]
            );
        }
    }
}
