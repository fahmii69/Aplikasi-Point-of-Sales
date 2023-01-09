<?php

namespace Database\Seeders;

use App\Models\Products\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attribute::insert([
            [
                'attribute_code'     => 'A1',
                'attribute_name'     => 'Size',
                'created_at'    => now()->toDateTimeString(),
                'updated_at'    => now()->toDateTimeString(),
            ],
            [
                'attribute_code'     => 'A2',
                'attribute_name'     => 'Color',
                'created_at'    => now()->toDateTimeString(),
                'updated_at'    => now()->toDateTimeString(),
            ],
            [
                'attribute_code'     => 'A3',
                'attribute_name'     => 'Style',
                'created_at'    => now()->toDateTimeString(),
                'updated_at'    => now()->toDateTimeString(),
            ],
            [
                'attribute_code'     => 'A4',
                'attribute_name'     => 'Level',
                'created_at'    => now()->toDateTimeString(),
                'updated_at'    => now()->toDateTimeString(),
            ],
        ]);
    }
}
