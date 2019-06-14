<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('adultsNum');
            $table->integer('children12');
            $table->integer('children2');
            $table->integer('singleRoomNum');
            $table->integer('doubleRoomNum');
            $table->date('orderDate');
            $table->text('fName')->nullable();
            $table->text('lName')->nullable();
            $table->text('gender')->nullable();
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->date('DOB');
            $table->integer('accomidation_id');
            $table->integer('hotel_id');
            $table->integer('option_id');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
