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
            $table->integer('payment_id',1);  
            $table->string('order_id', 50);
            $table->decimal('status_code',3,0);
            $table->decimal('amount',6,0);
            $table->timestamp('time');
            $table->timestamps();
            $table->foreign('order_id')->references('order_id')->on('orders');
            $table->foreign('status_code')->references('status_code')->on('status');
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
