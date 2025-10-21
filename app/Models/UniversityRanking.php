<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UniversityRanking extends Model
{
    protected $fillable = [
        'university_id',
        'year',
        'rank',
        'overall_score',
        'academic_reputation',
        'employer_reputation',
        'faculty_student_ratio',
        'citations_per_faculty',
        'international_faculty',
        'international_students',
        'research_discovery',
        'learning_experience',
        'employability',
        'global_engagement',
        'sustainability'
    ];

    protected $casts = [
        'overall_score' => 'decimal:2',
        'academic_reputation' => 'decimal:2',
        'employer_reputation' => 'decimal:2',
        'faculty_student_ratio' => 'decimal:2',
        'citations_per_faculty' => 'decimal:2',
        'international_faculty' => 'decimal:2',
        'international_students' => 'decimal:2',
        'research_discovery' => 'decimal:2',
        'learning_experience' => 'decimal:2',
        'employability' => 'decimal:2',
        'global_engagement' => 'decimal:2',
        'sustainability' => 'decimal:2',
    ];

    /**
     * Get the university that owns the ranking.
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }
}
