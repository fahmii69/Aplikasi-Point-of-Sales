<?php

namespace Database\Seeders;

use App\Models\Products\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TagSeeder extends Seeder
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
            Tag::insert(
                [
                    // 'tag_id' => $faker->unique()->lexify('MOD-???????'),
                    'tag_name' => $faker->unique()->meatName(),
                ]
            );
        }
    }
}
