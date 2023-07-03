<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('sale_return_id')->nullable();
            $table->decimal('amount', 28,2);
            $table->string('remarks')->nullable();
            $table->string('trx');
            $table->softDeletes();
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
        Schema::dropIfExists('customer_payment');
    }
}
