<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // creacion de la migracion de la tabla intermedia movies_genders
        Schema::create('movies_genders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movie_id');
            $table->unsignedBigInteger('gender_id');

            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
            $table->unique(['movie_id', 'gender_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('movie_gender');
    }
};
