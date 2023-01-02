<?php

namespace Database\Seeders;

use App\Models\Products\Brand;
use App\Models\Products\Category;
use App\Models\Products\Product;
use App\Models\Stocks\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
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
            $product = Product::create(
                [
                    'product_code'    => $faker->unique()->lexify('PDT-???????'),
                    'product_name'    => $faker->unique()->foodName(),
                    'product_price'   => $faker->numerify('###000'),
                    'supplier_code'   => Supplier::inRandomOrder()->first()->supplier_code,
                    'category_code'   => Category::inRandomOrder()->first()->category_code,
                    'type_product'    => '1',
                    'model_code'      => '1',
                    'brand_code'      => Brand::inRandomOrder()->first()->brand_code,
                    'levelAttribute'  => '1',
                    'detailAttribute' => '1',

                    'created_at'  => now()->toDateTimeString(),
                    'updated_at'  => now()->toDateTimeString(),
                ]
            );

            // foreach (range(1, rand(1, 3)) as $k) {
            //     PeminjamanDetail::create([
            //         'buku_id'       => rand(1, 25),
            //         'peminjaman_id' => $peminjaman->id,
            //         'status'        => $faker->randomElements(['SEDANG_DIPINJAM', 'HILANG', 'DIKEMBALIKAN'])[0],
            //     ]);
            // }
        }
    }
}
