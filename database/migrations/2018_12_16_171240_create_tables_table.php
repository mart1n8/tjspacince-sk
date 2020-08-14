<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('season_id');
            $table->text('table_text');
            $table->string('title')->default("");
            
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::dropIfExists('tables', function (Blueprint $table) {
            $table->dropForeign('matches_team_id_foreign');
            $table->dropForeign('matches_season_id_foreign');
         
        }); 
    }
}
