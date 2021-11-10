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
            $table->string("order_id", 20);
            $table->primary(["order_id"]);
            $table->string("name",30);
            $table->string("phone",20);
            $table->string("email",50);
            $table->dateTime("time");
            $table->unsignedBigInteger("studio_id");
            $table->integer("duration");
            $table->string("status", 50);
            $table->foreign("studio_id")->references("studio_id")->on("studios");
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
