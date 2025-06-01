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
        Schema::create('word_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('word_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('play_count')->default(0);
            $table->unsignedInteger('correct_count')->default(0);
            $table->unsignedInteger('hint_count')->default(0);
            $table->unsignedInteger('flashcard_count')->default(0);
            $table->timestamps();
        
            $table->unique('word_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('word_statistics');
    }
};
