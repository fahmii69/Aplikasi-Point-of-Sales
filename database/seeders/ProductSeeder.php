<?php

namespace Database\Seeders;

use App\Models\Products\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            [
                'product_name'    => 'Bakso Sus',
                'product_price'   => '10000',
                'supplier_code'   => 'SUP-0169P317',
                'category_code'   => 'CAT-99789B75',
                'type_product'    => '1',
                'model_code'      => '1',
                'brand_code'      => '1',
                'levelAttribute'  => '1',
                'detailAttribute' => '1',
            ],
            [
                'product_name'    => 'Gatsby',
                'product_price'   => '5000',
                'supplier_code'   => 'SUP-3612Z666',
                'category_code'   => 'CAT-B6402729',
                'type_product'    => '2',
                'model_code'      => '2',
                'brand_code'      => '2',
                'levelAttribute'  => '2',
                'detailAttribute' => '2',
            ],
            [
                'product_name'    => 'KukuBambang',
                'product_price'   => '2500',
                'supplier_code'   => 'SUP-98393D42',
                'category_code'   => 'CAT-9888548E',
                'type_product'    => '3',
                'model_code'      => '3',
                'brand_code'      => '3',
                'levelAttribute'  => '3',
                'detailAttribute' => '3',
            ],
        ]);
    }
}
