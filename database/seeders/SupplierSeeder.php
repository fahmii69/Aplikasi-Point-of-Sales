<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 5; $i++) {

            Supplier::insert(
                [
                    'supplier_code'    => $faker->unique()->lexify('SUP-???????'),
                    'supplier_name'    => $faker->company(),
                    'supplier_address' => $faker->city(),
                    'supplier_phone'   => $faker->phoneNumber(),
                    'created_at'       => now()->toDateTimeString(),
                    'updated_at'       => now()->toDateTimeString(),
                ]
            );
        }
    }
}
