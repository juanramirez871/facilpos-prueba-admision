<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // creacion de la migracion movies
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lenguage') -> nullable();
            $table->string('title') -> nullable();
            $table->text('summary') -> nullable();
            $table->string('poster') -> nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
