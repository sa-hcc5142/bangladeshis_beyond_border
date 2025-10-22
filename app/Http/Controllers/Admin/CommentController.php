<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Events\CommentApproved;
use App\Events\CommentRejected;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin'); // Only admins can approve/reject
    }

    /**
     * Show all pending comments
     */
    public function index(Request $request)
    {
        $query = Comment::with(['user', 'answeredBy'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status')) {
            if ($request->status === 'pending') {
                $query->pending();
            } elseif ($request->status === 'approved') {
                $query->approved();
            } elseif ($request->status === 'rejected') {
                $query->where('is_approved', false)
                      ->whereNotNull('rejected_at');
            }
        } else {
            $query->pending(); // Default to pending
        }

        $comments = $query->paginate(20);

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Approve a comment and optionally provide an answer
     */
    public function approve(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'answer' => 'nullable|string|max:2000',
        ]);

        $comment->update([
            'is_approved' => true,
            'approved_at' => now(),
            'answer' => $validated['answer'] ?? null,
            'answered_by' => isset($validated['answer']) ? auth()->id() : null,
        ]);

        // Fire event for notification
        event(new CommentApproved($comment));

        return back()->with('success', 'Comment approved successfully!');
    }

    /**
     * Reject a comment with a reason
     */
    public function reject(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $comment->update([
            'is_approved' => false,
            'rejected_at' => now(),
        ]);

        // Fire event for warning creation
        event(new CommentRejected($comment, $validated['reason']));

        return back()->with('success', 'Comment rejected and warning issued.');
    }

    /**
     * Answer an approved comment
     */
    public function answer(Request $request, Comment $comment)
    {
        if (!$comment->is_approved) {
            return back()->withErrors(['error' => 'Cannot answer unapproved comments.']);
        }

        $validated = $request->validate([
            'answer' => 'required|string|max:2000',
        ]);

        $comment->update([
            'answer' => $validated['answer'],
            'answered_by' => auth()->id(),
        ]);

        return back()->with('success', 'Answer provided successfully!');
    }

    /**
     * Delete a comment permanently
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully!');
    }
}
