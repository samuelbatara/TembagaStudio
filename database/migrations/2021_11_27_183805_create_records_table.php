<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->string('order_id', 50);
            $table->integer('admin_id');
            $table->primary(array('order_id', 'admin_id'));
            $table->string('description');
            $table->foreign('order_id')->references('order_id')->on('orders');
            $table->foreign('admin_id')->references('admin_id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
