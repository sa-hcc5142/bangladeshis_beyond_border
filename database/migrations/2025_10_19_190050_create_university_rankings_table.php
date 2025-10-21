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
        Schema::create('university_rankings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('university_id')->constrained()->onDelete('cascade');
            $table->integer('year');
            $table->integer('rank');
            $table->decimal('overall_score', 5, 2); // e.g., 98.50
            $table->decimal('academic_reputation', 5, 2)->nullable();
            $table->decimal('employer_reputation', 5, 2)->nullable();
            $table->decimal('faculty_student_ratio', 5, 2)->nullable();
            $table->decimal('citations_per_faculty', 5, 2)->nullable();
            $table->decimal('international_faculty', 5, 2)->nullable();
            $table->decimal('international_students', 5, 2)->nullable();
            $table->decimal('research_discovery', 5, 2)->nullable();
            $table->decimal('learning_experience', 5, 2)->nullable();
            $table->decimal('employability', 5, 2)->nullable();
            $table->decimal('global_engagement', 5, 2)->nullable();
            $table->decimal('sustainability', 5, 2)->nullable();
            $table->timestamps();
            
            $table->unique(['university_id', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_rankings');
    }
};
