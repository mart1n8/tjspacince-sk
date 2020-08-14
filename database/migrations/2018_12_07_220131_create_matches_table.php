<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('season_id');
            $table->boolean('home_away')->default(0);
            $table->unsignedInteger('club_id');
            $table->dateTime('match_datetime');
            $table->boolean('is_bus')->nullable()->default(0);
            $table->time('bus_time')->default(NULL)->nullable();
            $table->string('result')->nullable()->default("");
            $table->string('short_info')->nullable();
            $table->text('about')->nullable();
            $table->timestamps();
            $table->string('slug')->unique();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
            $table->foreign('club_id')->references('id')->on('clubs')->onDelete('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches', function (Blueprint $table) {
            $table->dropForeign('matches_team_id_foreign');
            $table->dropForeign('matches_season_id_foreign');
            $table->dropForeign('matches_club_id_foreign');
           
        });    

    }
}