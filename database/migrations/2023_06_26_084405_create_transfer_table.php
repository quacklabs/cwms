<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_no');
            $table->unsignedBigInteger('from')->nullable();
            $table->unsignedBigInteger('to');
            $table->date('transfer_date');
            $table->text('note')->nullable();
            $table->string('type');
            $table->boolean('balanced')->default(false);
            $table->softDeletes();
            $table->timestamps();

            // $table->foreign('from_warehouse')->references('id')->on('warehouse')->onDelete('cascade');
            // $table->foreign('to_warehouse')->references('id')->on('warehouse')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('transfer');
    }
}
