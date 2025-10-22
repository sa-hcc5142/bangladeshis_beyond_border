<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * Get all comments (questions) for this country
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get approved comments only
     */
    public function approvedComments()
    {
        return $this->comments()->approved();
    }

    /**
     * Get pending comments only
     */
    public function pendingComments()
    {
        return $this->comments()->pending();
    }
}
