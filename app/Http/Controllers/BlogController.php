<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of published blogs
     */
    public function index()
    {
        $blogs = Blog::with('author')
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        return view('blogs.index', compact('blogs'));
    }

    /**
     * Display the specified blog with its Q&A
     */
    public function show($slug)
    {
        $blog = Blog::with(['author', 'approvedComments.user', 'approvedComments.answeredBy'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('blogs.show', compact('blog'));
    }
}
