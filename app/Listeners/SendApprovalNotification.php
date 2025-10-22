<?php

namespace App\Listeners;

use App\Events\CommentApproved;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

/**
 * LAB CONCEPT: Listeners
 * This listener handles CommentApproved event by sending email notification.
 * Demonstrates event-driven architecture and decoupled code.
 */
class SendApprovalNotification
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
    public function handle(CommentApproved $event): void
    {
        $comment = $event->comment;
        $user = $comment->user;

        // Log for development (since we may not have email configured)
        Log::info("Comment #{$comment->id} approved for user {$user->email}");

        // In production, you would send actual email:
        // Mail::to($user->email)->send(new CommentApprovedMail($comment));
        
        // For now, we'll just log it
        Log::info("Approval notification sent to {$user->email}");
    }
}
