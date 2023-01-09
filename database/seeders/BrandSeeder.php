<?php

namespace Database\Seeders;

use App\Models\Products\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 2; $i++) {
            Brand::insert(
                [
                    'brand_code' => $faker->unique()->lexify('BRN-???????'),
                    'brand_name' => $faker->word(),
                ]
            );
        }
    }
}
