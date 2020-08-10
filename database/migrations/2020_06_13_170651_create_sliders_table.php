<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('picture',300);
            $table->string('title',200);
            $table->string('description',300)->nullable(true);
            $table->string('link',300)->nullable(true);
            $table->boolean('priority')->default(0);
            $table->boolean('status')->default(0);
            $table->boolean('slider_type');
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
        Schema::dropIfExists('sliders');
    }
}
