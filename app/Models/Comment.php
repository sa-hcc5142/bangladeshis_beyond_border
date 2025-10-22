<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'commentable_type',
        'commentable_id',
        'question',
        'answer',
        'answered_by',
        'status',
        'rejection_reason',
        'approved_at',
        'answered_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'answered_at' => 'datetime',
    ];

    /**
     * User who posted the question
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * User who answered the question
     */
    public function answeredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'answered_by');
    }

    /**
     * Warnings associated with this comment
     */
    public function warnings(): HasMany
    {
        return $this->hasMany(CommentWarning::class);
    }

    /**
     * Scope for approved comments
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for pending comments
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for country comments
     */
    public function scopeCountry($query, $countrySlug)
    {
        return $query->where('commentable_type', 'Country')
                     ->where('commentable_id', $countrySlug);
    }

    /**
     * Scope for blog comments
     */
    public function scopeBlog($query, $blogId)
    {
        return $query->where('commentable_type', 'Blog')
                     ->where('commentable_id', $blogId);
    }
}
