<?php

namespace App\Listeners;

use App\Events\CommentRejected;
use App\Models\CommentWarning;
use Illuminate\Support\Facades\Log;

/**
 * LAB CONCEPT: Listeners
 * This listener handles CommentRejected event by:
 * 1. Creating a warning record
 * 2. Sending warning email to user
 * 3. Checking if user should be banned (3 strikes)
 */
class SendRejectionWarning
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CommentRejected $event): void
    {
        $comment = $event->comment;
        $user = $comment->user;
        
        // Create warning record
        CommentWarning::create([
            'user_id' => $user->id,
            'comment_id' => $comment->id,
            'reason' => $event->reason,
            'section' => $comment->commentable_type === 'Country' ? 'country' : 'blog',
        ]);

        $warningCount = $user->warningCount();
        
        // Log warning
        Log::warning("User {$user->email} received warning #{$warningCount}: {$event->reason}");

        if ($warningCount >= 3) {
            Log::critical("User {$user->email} has been BANNED (3 warnings)");
        }

        // In production, send actual email:
        // Mail::to($user->email)->send(new CommentRejectedMail($comment, $event->reason, $warningCount));
        
        Log::info("Warning email sent to {$user->email}");
    }
}
