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
            $table->string('order_id', 50);
            $table->primary('order_id');
            $table->string('name', 50);
            $table->string('phone', 20);
            $table->string('email', 50); 
            $table->timestamp('time');
            $table->integer('packet_id');
            $table->decimal('duration',2,0);
            $table->string('status',15);
            $table->timestamps();
            $table->foreign('packet_id')->references('packet_id')->on('packets');
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
