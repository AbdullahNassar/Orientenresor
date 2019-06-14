<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
            $table->text('content')->nullable();
            $table->text('image')->nullable();
            $table->text('features')->nullable();
            $table->text('include')->nullable();
            $table->text('galleryContent')->nullable();
            $table->text('galleryVideo')->nullable();
            $table->integer('destination_id');
            $table->tinyInteger('view');
            $table->tinyInteger('active');
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
