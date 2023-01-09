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
        Schema::create('modifier_details', function (Blueprint $table) {
            $table->id();
            $table->string('modifier_code')->constrained();
            $table->string('modifier_detailCode');
            $table->string('modifier_detailName');
            $table->string('modifier_price');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('modifier_details');
    }
};
