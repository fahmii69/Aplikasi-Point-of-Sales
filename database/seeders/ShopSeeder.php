<?php

namespace Database\Seeders;

use App\Models\Stocks\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shop::insert(
            [
                'shop_code'     => 'SHOP-1111111',
                'shop_name'     => 'ZoelStore-1',
                'shop_address'  => 'Denpasar',
                'shop_tax'      => 10,
                'shop_currency' => 'IDR',
                'shop_default'  => '',
                'created_at'    => now()->toDateTimeString(),
                'updated_at'    => now()->toDateTimeString(),
            ],
            [
                'shop_code'     => 'SHOP-222222',
                'shop_name'     => 'ZoelStore-2',
                'shop_address'  => 'Taban',
                'shop_tax'      => 5,
                'shop_currency' => 'IDR',
                'shop_default'  => '',
                'created_at'    => now()->toDateTimeString(),
                'updated_at'    => now()->toDateTimeString(),
            ],
        );
    }
}
