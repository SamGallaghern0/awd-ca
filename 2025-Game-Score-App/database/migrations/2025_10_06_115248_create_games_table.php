<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {   /*This is the database table where the layout for a game is.*/
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('genre')->nullable();
            $table->integer('year');
            $table->string('image');
            $table->timestamps();   /*Instead of using two seperate time stamps for the database, it's just the one.*/
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
