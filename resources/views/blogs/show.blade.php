@extends('layouts.main')

@section('title', $blog->title . ' - Bangladeshis Beyond Border')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('blogs.index') }}" class="inline-flex items-center text-cyan-600 hover:text-cyan-700 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Blogs
            </a>
        </div>

        <!-- Blog Post -->
        <article class="bg-white rounded-2xl shadow-xl p-8 mb-8 animate__animated animate__fadeInUp">
            <!-- Title -->
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">
                {{ $blog->title }}
            </h1>

            <!-- Meta Info -->
            <div class="flex items-center text-gray-600 mb-8 pb-6 border-b border-gray-200">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($blog->author->name) }}&background=0891b2&color=fff" 
                     alt="{{ $blog->author->name }}"
                     class="w-12 h-12 rounded-full mr-4">
                <div>
                    <p class="font-semibold text-gray-900">{{ $blog->author->name }}</p>
                    <div class="flex items-center text-sm">
                        <i class="fas fa-calendar text-cyan-600 mr-2"></i>
                        <span>{{ $blog->published_at->format('F d, Y') }}</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-clock text-cyan-600 mr-2"></i>
                        <span>{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min read</span>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="prose prose-lg max-w-none mb-8">
                {!! nl2br(e($blog->content)) !!}
            </div>
        </article>

        <!-- Q&A Section -->
        <div class="bg-white rounded-2xl shadow-xl p-8 animate__animated animate__fadeInUp">
            <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-comments text-cyan-600 mr-3"></i>
                Questions & Answers
                <span class="ml-3 text-lg font-normal text-gray-500">({{ $blog->approvedComments->count() }})</span>
            </h2>

            <!-- Ask Question Form -->
            @auth
                <div class="bg-gradient-to-r from-cyan-50 to-blue-50 rounded-xl p-6 mb-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">
                        <i class="fas fa-question-circle text-cyan-600 mr-2"></i>
                        Ask a Question
                    </h3>
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="commentable_type" value="App\Models\Blog">
                        <input type="hidden" name="commentable_id" value="{{ $blog->id }}">
                        
                        <div class="mb-4">
                            <label for="question" class="block text-sm font-medium text-gray-700 mb-2">
                                Your Question
                            </label>
                            <textarea 
                                id="question" 
                                name="question" 
                                rows="4" 
                                required
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-cyan-200 focus:border-cyan-500 transition @error('question') border-red-500 @enderror"
                                placeholder="Ask your question about this blog post...">{{ old('question') }}</textarea>
                            @error('question')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn-animated bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-3 px-6 rounded-xl transition-all">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Submit Question
                        </button>
                    </form>
                </div>
            @else
                <div class="bg-gray-50 rounded-xl p-6 mb-8 text-center">
                    <i class="fas fa-lock text-gray-400 text-3xl mb-3"></i>
                    <p class="text-gray-600 mb-4">Please login to ask questions about this blog post</p>
                    <a href="{{ route('login') }}" class="inline-block bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-2 px-6 rounded-xl transition-all">
                        Login to Ask Question
                    </a>
                </div>
            @endauth

            <!-- Display Q&A -->
            @if($blog->approvedComments->count() > 0)
                <div class="space-y-6">
                    @foreach($blog->approvedComments as $comment)
                        <div class="border-l-4 border-cyan-600 pl-6 py-4 bg-gray-50 rounded-r-xl">
                            <!-- Question -->
                            <div class="mb-4">
                                <div class="flex items-start mb-2">
                                    <i class="fas fa-question-circle text-cyan-600 text-xl mr-3 mt-1"></i>
                                    <div class="flex-1">
                                        <div class="flex items-center mb-2">
                                            <span class="font-semibold text-gray-900">{{ $comment->user->name }}</span>
                                            <span class="mx-2 text-gray-400">•</span>
                                            <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-gray-700">{{ $comment->question }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Answer -->
                            @if($comment->answer)
                                <div class="ml-8 bg-white rounded-xl p-4 border border-gray-200">
                                    <div class="flex items-start">
                                        <i class="fas fa-reply text-emerald-600 text-xl mr-3 mt-1"></i>
                                        <div class="flex-1">
                                            <div class="flex items-center mb-2">
                                                <span class="font-semibold text-gray-900">{{ $comment->answeredBy->name }}</span>
                                                <span class="ml-2 px-2 py-1 bg-emerald-100 text-emerald-700 text-xs font-medium rounded-full">
                                                    Author
                                                </span>
                                                <span class="mx-2 text-gray-400">•</span>
                                                <span class="text-sm text-gray-500">{{ $comment->answered_at ? $comment->answered_at->diffForHumans() : $comment->updated_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-gray-700">{{ $comment->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="ml-8 bg-yellow-50 rounded-xl p-3 border border-yellow-200">
                                    <p class="text-sm text-yellow-700">
                                        <i class="fas fa-clock mr-2"></i>
                                        Awaiting answer from the author...
                                    </p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-comments text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-500 text-lg">No questions yet. Be the first to ask!</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
