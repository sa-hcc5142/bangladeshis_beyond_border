<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('banned'); // Check if user is banned
    }

    /**
     * Store a new question/comment
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'commentable_type' => 'required|in:App\Models\Country,App\Models\Blog',
            'commentable_id' => 'required|integer',
            'content' => 'required|string|min:10|max:1000',
        ]);

        // Create comment (pending approval)
        $comment = Comment::create([
            'user_id' => auth()->id(),
            'commentable_type' => $validated['commentable_type'],
            'commentable_id' => $validated['commentable_id'],
            'content' => $validated['content'],
            'is_approved' => false, // Requires admin approval
        ]);

        return back()->with('success', 'Your question has been submitted and is pending approval.');
    }

    /**
     * Show user's own comments
     */
    public function myComments()
    {
        $comments = Comment::with(['answeredBy'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('comments.my-comments', compact('comments'));
    }
}
