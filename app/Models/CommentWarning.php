<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentWarning extends Model
{
    protected $fillable = [
        'user_id',
        'comment_id',
        'reason',
        'section',
    ];

    /**
     * User who received the warning
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Comment that triggered the warning
     */
    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }
}
