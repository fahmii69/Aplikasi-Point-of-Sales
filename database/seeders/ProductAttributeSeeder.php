<?php

namespace Database\Seeders;

use App\Models\Products\Attribute;
use App\Models\Products\Product;
use App\Models\Products\ProductAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 10; $i++) {
            ProductAttribute::insert(
                [
                    'product_attributeCode' => $faker->unique()->numerify('PA-#'),
                    'product_code'          => Product::inRandomOrder()->first()->product_code,
                    'attribute_code'        => Attribute::inRandomOrder()->first()->attribute_code,
                    'level'                 => $faker->numberBetween(1, 3),
                ]
            );
        }
    }
}
