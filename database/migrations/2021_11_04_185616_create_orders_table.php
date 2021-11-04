<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('create_user_id');
            $table->string('reference')->nullable();
            $table->string('additional')->nullable();
            $table->integer('channel_id');
            $table->integer('costs')->nullable();
            $table->dateTime('requested_date')->nullable();
            $table->string('remarks')->nullable();
            $table->string('customer');
            $table->string('email')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->integer('countryes_id')->nullable();
            $table->string('state_provincy')->nullable();
            $table->integer('state_us')->nullable();
            $table->integer('status')->default(1);
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
