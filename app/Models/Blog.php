<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'author_id',
        'is_published',
        'published_at',
        'category',
        'excerpt',
        'featured_image',
        'read_time',
    ];

    /**
     * Get the author of the blog
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get all comments (questions) for this blog
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
