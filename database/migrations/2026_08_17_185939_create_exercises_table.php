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
    Schema::create('exercises', function (Blueprint $table) {
        $table->id();
        // Category of the exercise
        $table->string('category_slug');
        // Exercise details
        $table->string('title');
        // Media
        $table->string('video');
        // Duration in seconds
        $table->integer('duration')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
