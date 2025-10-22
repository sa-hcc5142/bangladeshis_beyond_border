<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Events\CommentApproved;
use Illuminate\Http\Request;

class ApproveCommentController extends Controller
{
    /**
     * Handle the incoming request - Quick approve without answer.
     */
    public function __invoke(Request $request, Comment $comment)
    {
        // Only admins can approve
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        // Approve the comment
        $comment->update([
            'is_approved' => true,
            'approved_at' => now(),
        ]);

        // Fire approval event
        event(new CommentApproved($comment));

        return back()->with('success', 'Comment approved successfully!');
    }
}
