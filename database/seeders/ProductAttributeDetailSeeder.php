<?php

namespace Database\Seeders;

use App\Models\Products\ProductAttribute;
use App\Models\Products\ProductAttributeDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductAttributeDetailSeeder extends Seeder
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
            ProductAttributeDetail::insert(
                [
                    'product_attributeCode' => ProductAttribute::inRandomOrder()->first()->product_attributeCode,
                    'detail_attribute'      => $faker->word(),
                ]
            );
        }
    }
}
