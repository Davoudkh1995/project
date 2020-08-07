<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('picture',1000)->nullable(false);
            $table->string('title',200);
            $table->string('slug',200);
            $table->string('tags',600)->nullable(true);
            $table->text('content');
            $table->unsignedInteger('categoryID_FK');
            $table->foreign('categoryID_FK')->references('id')->on('category_services')->onDelete('cascade');
            $table->unsignedInteger('usersID_FK');
            $table->foreign('usersID_FK')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('priority');
            $table->boolean('status');
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
        Schema::dropIfExists('portfolios');
    }
}
