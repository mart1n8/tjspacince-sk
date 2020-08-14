<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('text');
            $table->string('slug');
            $table->string('tags')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->integer('num_views')->default(0)->nullable();
            $table->datetime('public_date')->nullable();
            $table->boolean('is_publised')->default(0)->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles', function (Blueprint $table) {
            $table->dropForeign('articles_user_id_foreign');         
        });
    }
}
