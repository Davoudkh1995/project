<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('title',200)->nullable(false);
            $table->string('picture',300)->nullable(false);
            $table->string('slug',200)->nullable(false);
            $table->string('url',500);
            $table->string('tags',600);
            $table->text('content');
            $table->boolean('popular');
            $table->boolean('priority');
            $table->boolean('status');
            $table->unsignedInteger('categoryID_FK');
            $table->foreign('categoryID_FK')->references('id')->on('category_articles');
            $table->unsignedInteger('usersID_FK');
            $table->foreign('usersID_FK')->references('id')->on('users');
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
        Schema::dropIfExists('articles');
    }
}
