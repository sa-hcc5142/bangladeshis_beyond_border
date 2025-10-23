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
        Schema::table('blogs', function (Blueprint $table) {
            if (!Schema::hasColumn('blogs', 'is_published')) {
                $table->boolean('is_published')->default(false)->after('content');
            }
            if (!Schema::hasColumn('blogs', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('is_published');
            }
            if (!Schema::hasColumn('blogs', 'category')) {
                $table->string('category')->nullable()->after('published_at');
            }
            if (!Schema::hasColumn('blogs', 'excerpt')) {
                $table->text('excerpt')->nullable()->after('category');
            }
            if (!Schema::hasColumn('blogs', 'featured_image')) {
                $table->string('featured_image')->nullable()->after('excerpt');
            }
            if (!Schema::hasColumn('blogs', 'read_time')) {
                $table->integer('read_time')->nullable()->comment('Reading time in minutes')->after('featured_image');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn(['is_published', 'published_at', 'category', 'excerpt', 'featured_image', 'read_time']);
        });
    }
};
