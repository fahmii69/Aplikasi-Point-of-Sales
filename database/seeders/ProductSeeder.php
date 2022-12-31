<?php

namespace Database\Seeders;

use App\Models\Products\Brand;
use App\Models\Products\Category;
use App\Models\Products\Product;
use App\Models\Supplier;
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

    // public function run()
    // {
    //     Product::insert([
    //         [
    //             'product_code'    => 'PDT-A8609470',
    //             'product_name'    => 'Bakso Sus',
    //             'product_price'   => '10000',
    //             'supplier_code'   => 'SUP-0169P317',
    //             'category_code'   => 'CAT-99789B75',
    //             'type_product'    => '1',
    //             'model_code'      => '1',
    //             'brand_code'      => '1',
    //             'levelAttribute'  => '1',
    //             'detailAttribute' => '1',
    //         ],
    //         [
    //             'product_code'    => 'PDT-C333318',
    //             'product_name'    => 'Gatsby',
    //             'product_price'   => '5000',
    //             'supplier_code'   => 'SUP-3612Z666',
    //             'category_code'   => 'CAT-B6402729',
    //             'type_product'    => '2',
    //             'model_code'      => '2',
    //             'brand_code'      => '2',
    //             'levelAttribute'  => '2',
    //             'detailAttribute' => '2',
    //         ],
    //         [
    //             'product_code'    => 'PDT-7T330732',
    //             'product_name'    => 'KukuBambang',
    //             'product_price'   => '2500',
    //             'supplier_code'   => 'SUP-98393D42',
    //             'category_code'   => 'CAT-9888548E',
    //             'type_product'    => '3',
    //             'model_code'      => '3',
    //             'brand_code'      => '3',
    //             'levelAttribute'  => '3',
    //             'detailAttribute' => '3',
    //         ],
    //     ]);
    // }
}
