<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::insert([
            [
                'supplier_code' => 'SUP-0169P317',
                'supplier_name' => 'Mahmudin Bakso',
                'supplier_address' => 'Denpasar',
                'supplier_phone' => '08123456789',
            ],
            [
                'supplier_code' => 'SUP-98393D42',
                'supplier_name' => 'Retno Cat',
                'supplier_address' => 'Taban',
                'supplier_phone' => '0898988786',
            ],
            [
                'supplier_code' => 'SUP-3612Z666',
                'supplier_name' => 'Thumbfun Barber',
                'supplier_address' => 'Batu',
                'supplier_phone' => '0876585757',
            ],

        ]);
    }
}
