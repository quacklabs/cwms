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
            $table->string('invoice_no')->unique();
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->date('date');
            $table->decimal('total_price', 28,8);
            $table->decimal('discount_amount', 28,8)->default(0.00);
            $table->decimal('received', 28,8)->default(0.00);
            $table->text('note')->nullable();
            $table->boolean('return_status')->default(false);
            $table->string('origin')->nullable();
            $table->string('status')->default('ordered');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('warehouse_id')->references('id')->on('warehouse')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('supplier')->onDelete('cascade');
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
