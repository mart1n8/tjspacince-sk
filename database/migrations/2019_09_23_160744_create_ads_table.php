<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('url')->nullable();
            $table->integer('views')->default(0);
            $table->integer('views_unq')->default(0);
            $table->integer('clicks')->default(0);
            $table->integer('clicks_unq')->default(0);
            $table->string('banner');
            $table->string('banner_size');
            $table->unsignedInteger('ad_campaign_id');
            $table->timestamps();

            $table->foreign('ad_campaign_id')->references('id')->on('ad_campaigns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
