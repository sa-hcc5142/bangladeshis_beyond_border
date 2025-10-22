<?php

namespace App\Events;

use App\Models\Comment;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * LAB CONCEPT: Events
 * This event is dispatched when a comment is rejected by admin.
 * It will trigger listeners to send warning email and track warnings.
 */
class CommentRejected
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Comment $comment;
    public string $reason;

    /**
     * Create a new event instance.
     */
    public function __construct(Comment $comment, string $reason)
    {
        $this->comment = $comment;
        $this->reason = $reason;
    }
}
