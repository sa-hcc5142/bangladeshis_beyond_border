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
        Schema::create('university_quick_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('university_id')->constrained()->onDelete('cascade');
            $table->string('undergraduate_admission_url', 500)->nullable();
            $table->string('postgraduate_admission_url', 500)->nullable();
            $table->string('academic_timeline_url', 500)->nullable();
            $table->string('fullride_scholarship_url', 500)->nullable();
            $table->string('partial_scholarship_url', 500)->nullable();
            $table->string('more_info_url', 500)->nullable();
            $table->timestamp('last_scraped_at')->nullable();
            $table->boolean('scraping_completed')->default(false);
            $table->timestamps();
            
            $table->index('university_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_quick_links');
    }
};
