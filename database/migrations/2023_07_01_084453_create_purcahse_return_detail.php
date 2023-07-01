<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurcahseReturnDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_return_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('return_id');
            $table->unsignedBigInteger('product_id');
            $table->string('serial');
            $table->decimal('price', 28,2);
            $table->timestamps();

            $table->foreign('return_id')->references('id')->on('purchase_return')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_return_detail');
    }
}
