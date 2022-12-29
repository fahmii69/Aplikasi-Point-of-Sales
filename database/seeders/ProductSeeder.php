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
                'name' => 'Bakso sus',
                'supplier_id' => '1',
                'retail_price' => '5000'
            ],
            [
                'name' => 'Cat Water',
                'supplier_id' => '2',
                'retail_price' => '6000'
            ],
            [
                'name' => 'Gatsby',
                'supplier_id' => '3',
                'retail_price' => '4000'
            ],
        ]);
    }
}
