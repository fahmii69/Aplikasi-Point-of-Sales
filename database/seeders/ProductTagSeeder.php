<?php

namespace Database\Seeders;

use App\Models\Product\Tag;
use App\Models\Products\Product;
use App\Models\Products\ProductTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 20; $i++) {
            ProductTag::insert(
                [
                    'product_code' => Product::inRandomOrder()->first()->product_code,
                    'tag_id'       => Tag::inRandomOrder()->first()->id,
                    'created_at'   => now()->toDateTimeString(),
                    'updated_at'   => now()->toDateTimeString(),
                ]
            );
        }
    }
}
