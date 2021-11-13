<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id("payment_id");
            $table->string("order_id", 20);
            $table->string("status_code", 50);
            $table->integer("amount");
            $table->dateTime("time");
            $table->foreign("status_code")->references("status_code")->on("status");
            $table->foreign("order_id")->references("order_id")->on("orders");
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
        Schema::dropIfExists('payments');
    }
}
