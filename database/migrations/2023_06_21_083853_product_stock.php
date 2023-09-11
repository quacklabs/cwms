<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stock', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->string('ownership')->default('GIT');
            $table->unsignedBigInteger('owner')->nullable();
            $table->string('serial')->unique();
            $table->boolean('sold')->default(false);
            $table->boolean('received')->default(false);
            $table->boolean('in_transit')->default(true);
            $table->unsignedBigInteger('sale_id')->nullable();
            $table->unsignedBigInteger('sold_by')->nullable();
            $table->unsignedBigInteger('sold_from')->nullable();
            $table->unsignedBigInteger('purchase_id');
            // $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouse')->onDelete('cascade');
            $table->foreign('purchase_id')->references('id')->on('purchase')->onDelete('cascade');

            // $table->foreign('sold_from')->references('id')->on('warehouse')->onDelete('cascade');
            $table->foreign('sold_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_stock');
    }
}
