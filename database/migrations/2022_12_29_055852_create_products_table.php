<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code');
            $table->string('product_name');
            $table->string('product_price')->default(0);
            $table->string('supplier_code')->constrained();
            $table->string('category_code')->constrained();
            $table->string('options')->default(0);
            $table->string('brand_code');
            // $table->string('levelAttribute')->nullable()->default(0);
            // $table->string('detailAttribute')->nullable()->default(0);
            $table->longText('product_picture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
