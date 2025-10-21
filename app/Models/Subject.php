<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'is_active',
        'category' // broad or specific
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the subject rankings for the subject.
     */
    public function subjectRankings(): HasMany
    {
        return $this->hasMany(SubjectRanking::class);
    }

    /**
     * Many-to-many relationship with universities
     */
    public function universities(): BelongsToMany
    {
        return $this->belongsToMany(University::class, 'subject_university')
            ->withPivot('rank', 'year', 'score', 'highlights')
            ->withTimestamps()
            ->orderBy('subject_university.rank');
    }

    /**
     * Get universities for a specific year
     */
    public function universitiesForYear($year = 2026): BelongsToMany
    {
        return $this->universities()->wherePivot('year', $year);
    }
}
