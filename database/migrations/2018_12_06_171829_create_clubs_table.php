<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('short_name')->nullable();
            $table->string('city');
            $table->string('slug')->unique();
            $table->text('about')->nullable();
            $table->string('website')->nullable();
            $table->string('fb_web')->nullable();
            $table->string('arena_gps')->nullable();
            $table->string('emblem')->nullable();
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
        Schema::dropIfExists('clubs');
    }
}
