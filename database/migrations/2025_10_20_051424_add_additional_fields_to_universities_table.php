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
        Schema::table('universities', function (Blueprint $table) {
            // Image fields
            $table->string('image_url')->nullable()->after('logo'); // Main campus image
            $table->string('banner_image')->nullable()->after('image_url'); // Header banner
            $table->string('thumbnail')->nullable()->after('banner_image'); // Small preview
            
            // Additional information
            $table->integer('founded_year')->nullable()->after('city');
            $table->enum('type', ['public', 'private'])->default('public')->after('founded_year');
            $table->integer('student_count')->nullable()->after('type');
            $table->integer('international_students')->nullable()->after('student_count');
            
            // Quick action URLs
            $table->string('admission_undergrad_url')->nullable()->after('website');
            $table->string('admission_postgrad_url')->nullable()->after('admission_undergrad_url');
            $table->string('scholarships_url')->nullable()->after('admission_postgrad_url');
            $table->string('application_timeline_url')->nullable()->after('scholarships_url');
            
            // Additional resource URLs
            $table->string('research_url')->nullable()->after('application_timeline_url');
            $table->string('facilities_url')->nullable()->after('research_url');
            $table->string('student_life_url')->nullable()->after('facilities_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('universities', function (Blueprint $table) {
            $table->dropColumn([
                'image_url',
                'banner_image',
                'thumbnail',
                'founded_year',
                'type',
                'student_count',
                'international_students',
                'admission_undergrad_url',
                'admission_postgrad_url',
                'scholarships_url',
                'application_timeline_url',
                'research_url',
                'facilities_url',
                'student_life_url'
            ]);
        });
    }
};
