<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seos', function (Blueprint $table) {
            $table->id();
            $table->string('title',90)->nullable(true);
            $table->string('description',191)->nullable(true);
            $table->string('canonical',400)->nullable(true);
            $table->string('keywords',700)->nullable(true);
            $table->boolean('follow')->default(0);
            $table->boolean('index')->default(0);
            $table->string('seo_url',400)->nullable(true);
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
        Schema::dropIfExists('seos');
    }
}
