<?php

namespace Database\Seeders;

use App\Models\Products\Product;
use App\Models\Stocks\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StockSeeder extends Seeder
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

        for ($i = 0; $i < 10; $i++) {
            Stock::create(
                [
                    'stock_code'      => $faker->unique()->lexify('STK-???????'),
                    'stock_quantity'  => $faker->randomNumber(2, false),
                    'product_code'    => Product::inRandomOrder()->first()->product_code,
                    'created_at'  => now()->toDateTimeString(),
                    'updated_at'  => now()->toDateTimeString(),
                ]
            );
        };
    }
}
