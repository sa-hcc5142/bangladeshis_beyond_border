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
        Schema::create('subject_university', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->foreignId('university_id')->constrained()->onDelete('cascade');
            $table->integer('rank')->nullable(); // Rank of university in this subject
            $table->integer('year')->default(2026);
            $table->decimal('score', 5, 2)->nullable();
            $table->text('highlights')->nullable(); // Notable achievements in this subject
            $table->timestamps();
            
            // Prevent duplicate entries
            $table->unique(['subject_id', 'university_id', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_university');
    }
};
