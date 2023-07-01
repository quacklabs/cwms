<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurcahseReturn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_return', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_id');
            $table->unsignedBigInteger('supplier_id');
            $table->date('date');
            $table->decimal('total_price', 28,2);
            $table->decimal('discount', 28,2)->default(0.00);
            $table->decimal('receivable', 28,2);
            $table->decimal('received', 28,2)->default(0.00);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('purchase_id')->references('id')->on('purchase')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_return');
    }
}
