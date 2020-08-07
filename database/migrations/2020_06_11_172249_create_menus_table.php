<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',30)->nullable(false);
            $table->string('slug',200)->nullable(false);
            $table->boolean('status');
            $table->integer('parent_id');
            $table->string('url',500);
            $table->integer('usersID_FK')->unsigned();
            $table->foreign('usersID_FK')->references('id')->on('users');
            $table->timestamps();
        });
        DB::statement($this->dropView());
        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
