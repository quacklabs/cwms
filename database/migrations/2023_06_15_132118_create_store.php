<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('store', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('address');
            $table->boolean('status')->default(true);
            $table->longText('notes')->nullable();
            $table->unsignedBigInteger('warehouse_id');
            $table->timestamps();
            // $table->foreign('warehouse_id')->references('id')->on('warehouse');
        });

        Schema::create('store_user', function (Blueprint $table) {
            // $table->id();
            // $table->string('name');
            // $table->longText('address');
            // $table->boolean('status')->default(true);
            // $table->longText('notes')->nullable();
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('store_id')->references('id')->on('store')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store');
        Schema::dropIfExists('store_user');
    }
}
