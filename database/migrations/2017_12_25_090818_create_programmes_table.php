<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programmes', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
            $table->text('content')->nullable();
            $table->text('destination')->nullable();
            $table->text('visit')->nullable();
            $table->text('transportation')->nullable();
            $table->text('distance')->nullable();
            $table->text('cuisines')->nullable();
            $table->text('residence')->nullable();
            $table->integer('tript_id');
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
