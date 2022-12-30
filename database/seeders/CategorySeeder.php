<?php

namespace Database\Seeders;

use App\Models\Products\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            [
                'category_code' => 'CAT-9888548E',
                'category_name' => 'Energy Drink',
                'isModifier'    => 0,
            ],
            [
                'category_code' => 'CAT-B6402729',
                'category_name' => 'Soda',
                'isModifier'    => 0,
            ],
            [
                'category_code' => 'CAT-99789B75',
                'category_name' => 'Food',
                'isModifier'    => 1,
            ],
            [
                'category_code' => 'CAT-86R8863',
                'category_name' => 'Shoes',
                'isModifier'    => 0,
            ],
        ]);
    }
}
