<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class University extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'country',
        'city',
        'region',
        'description',
        'logo',
        'website',
        'is_active',
        // New fields
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
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'founded_year' => 'integer',
        'student_count' => 'integer',
        'international_students' => 'integer',
    ];

    /**
     * Get the university rankings for the university.
     */
    public function rankings(): HasMany
    {
        return $this->hasMany(UniversityRanking::class);
    }

    /**
     * Get the current year ranking for the university.
     */
    public function currentRanking()
    {
        return $this->rankings()
            ->where('year', date('Y'))
            ->first();
    }

    /**
     * Get the subject rankings for the university.
     */
    public function subjectRankings(): HasMany
    {
        return $this->hasMany(SubjectRanking::class);
    }

    /**
     * Get the latest ranking for the university.
     */
    public function latestRanking()
    {
        return $this->rankings()
            ->orderBy('year', 'desc')
            ->first();
    }

    /**
     * Many-to-many relationship with subjects
     */
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_university')
            ->withPivot('rank', 'year', 'score', 'highlights')
            ->withTimestamps();
    }

    /**
     * Get the main image URL or fallback to a placeholder
     */
    public function getImageAttribute()
    {
        return $this->image_url ?? $this->banner_image ?? 'https://via.placeholder.com/800x400?text=' . urlencode($this->name);
    }

    /**
     * Get the thumbnail or fallback to logo or placeholder
     */
    public function getThumbnailAttribute()
    {
        return $this->attributes['thumbnail'] ?? $this->logo ?? 'https://via.placeholder.com/150?text=' . urlencode(substr($this->name, 0, 3));
    }

    /**
     * Get the quick links for the university.
     */
    public function quickLinks()
    {
        return $this->hasOne(UniversityQuickLink::class);
    }
}
