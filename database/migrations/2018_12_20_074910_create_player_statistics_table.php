<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('player_id');
            $table->unsignedInteger('match_id');
            $table->unsignedInteger('season_id');
            $table->tinyInteger('yellowCard')->nullable()->default(0);
            $table->tinyInteger('redCard')->nullable()->default(0);
            $table->tinyInteger('goal')->nullable()->default(0);
            $table->boolean('played')->nullable()->default(1);
            $table->boolean('basicSquad')->nullable()->default(1);
            $table->tinyInteger('shirtNum')->nullable()->default(0);
            $table->tinyInteger('min_start')->nullable()->default(0);
            $table->tinyInteger('min_endup')->nullable()->default(90);
            $table->timestamps();
            
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_statistics', function (Blueprint $table) {
            $table->dropForeign('player_statistics_player_id_foreign');
            $table->dropForeign('player_statistics_match_id_foreign');
            $table->dropForeign('player_statistics_season_id_foreign');
           
        });    
    }
}
