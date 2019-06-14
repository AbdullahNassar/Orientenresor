<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
            $table->text('content')->nullable();
            $table->text('galleryContent')->nullable();
            $table->text('galleryVideo')->nullable();
            $table->text('visaContent')->nullable();
            $table->text('vaccineContent')->nullable();
            $table->integer('continent_id');
            $table->integer('category_id');
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
