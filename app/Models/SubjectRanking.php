<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubjectRanking extends Model
{
    protected $fillable = [
        'university_id',
        'subject_id',
        'year',
        'rank',
        'score'
    ];

    protected $casts = [
        'score' => 'decimal:2',
    ];

    /**
     * Get the university that owns the subject ranking.
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Get the subject that owns the subject ranking.
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
