<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statics', function (Blueprint $table) {
            $table->increments('id');
            $table->text('topTrips')->nullable();
            $table->text('categories')->nullable();
            $table->text('recommendations')->nullable();
            $table->text('blogs')->nullable();
            $table->text('homeFeaturesContent')->nullable();
            $table->text('homeFeatures')->nullable();
            $table->text('destnations')->nullable();
            $table->text('climate')->nullable();
            $table->text('optionsContent')->nullable();
            $table->text('aboutHead')->nullable();
            $table->text('aboutContent')->nullable();
            $table->text('aboutImage')->nullable();
            $table->text('teamContent')->nullable();
            $table->text('goal')->nullable();
            $table->text('mission')->nullable();
            $table->text('vision')->nullable();
            $table->text('benefits')->nullable();
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
