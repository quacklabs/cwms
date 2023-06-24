<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('invoice_no');
            $table->unsignedBigInteger('warehouse_id');
            $table->date('sale_date');
            $table->decimal('total_price', 28,2)->default(0.00);
            $table->decimal('discount_amount', 28,2)->default(0.00);
            $table->decimal('receiveable_amount', 28,2)->default(0.00);
            $table->decimal('received_amount', 28,2)->default(0.00);
            $table->decimal('due_amount',28,2)->default(0.00);
            $table->longText('notes')->nullable();
            $table->boolean('return_status')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouse')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}