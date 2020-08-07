<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('serviceID_FK')->nullable(false);
            $table->foreign('serviceID_FK')->on('services')->references('id');
            $table->string('imageUrl',250)->nullable(false);
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
        Schema::dropIfExists('image_services');
    }
}
