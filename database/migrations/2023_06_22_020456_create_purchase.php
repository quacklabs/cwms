<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreatePurchase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->string('invoice_no');
            $table->unsignedBigInteger('warehouse_id');
            // $table->date('purchase_date');
            $table->decimal('total_price', 28,2);
            $table->decimal('discount_amount', 28,2)->default(0.00);
            $table->decimal('payable_amount', 28,2);
            $table->decimal('paid_amount', 28,2);
            $table->decimal('due_amount', 28,2);
            $table->text('note')->nullable();
            $table->boolean('return_status')->default(false);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('warehouse_id')->references('id')->on('warehouse')->onDelete('cascade');
            $table->index(['invoice_no']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase');
    }
}