<?php

namespace Database\Seeders;

use App\Models\Products\Product;
use App\Models\Products\ProductVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $faker->addProvider(new \FakerRestaurant\Provider\id_ID\Restaurant($faker));

        for ($i = 0; $i < 15; $i++) {
            ProductVariant::create(
                [
                    'variant_code'     => $faker->unique()->lexify('PROD-???????'),
                    'product_code'     => Product::inRandomOrder()->first()->product_code,
                    'variant_name'     => 'black / 40',
                    'variant_list'     => 'black,40',
                    'product_price'    => $faker->numerify('#000'),
                    'product_barcode'  => $faker->numerify('#####'),
                    'product_buyPrice' => $faker->numerify('#000'),
                    'created_at'       => now()->toDateTimeString(),
                    'updated_at'       => now()->toDateTimeString(),
                ]
            );
        }
    }
}
