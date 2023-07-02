<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleReturn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_return', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('customer_id');
            $table->date('date');
            $table->decimal('total_price', 28,2);
            $table->decimal('discount', 28,2)->default(0.00);
            $table->decimal('receivable', 28,2);
            $table->decimal('received', 28,2)->default(0.00);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('sale_id')->references('id')->on('sale')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_return');
    }
}
