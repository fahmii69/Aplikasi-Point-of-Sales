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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->string('variant_code');
            $table->string('product_code');
            $table->string('variant_name');
            $table->string('variant_list');
            $table->string('product_price');
            $table->string('product_barcode')->unique()->nullable()->default('');
            $table->string('product_buyPrice');
            $table->string('product_taxRate')->default(0);
            $table->string('markup_price')->nullable();
            $table->string('status')->nullable();
            $table->string('reorder_quantity')->nullable()->default(0);
            $table->string('isActive')->nullalble()->default(1);
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
        Schema::dropIfExists('product_variants');
    }
};
