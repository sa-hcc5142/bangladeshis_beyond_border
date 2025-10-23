@extends('layouts.main')

@section('title', 'Blog - Bangladeshis Beyond Border')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12 animate__animated animate__fadeInDown">
            <h1 class="text-5xl font-extrabold text-gray-900 mb-4">
                <i class="fas fa-blog text-cyan-600 mr-3"></i>
                Our Blog
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Insights, tips, and stories about international education and student life abroad
            </p>
        </div>

        @if($blogs->count() > 0)
            <!-- Blog Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($blogs as $blog)
                    <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden animate__animated animate__fadeInUp">
                        <!-- Blog Card -->
                        <div class="p-6">
                            <!-- Meta Info -->
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <i class="fas fa-user-circle text-cyan-600 mr-2"></i>
                                <span class="font-medium">{{ $blog->author->name }}</span>
                                <span class="mx-2">•</span>
                                <i class="fas fa-calendar text-cyan-600 mr-2"></i>
                                <span>{{ $blog->published_at->format('M d, Y') }}</span>
                            </div>

                            <!-- Title -->
                            <h2 class="text-2xl font-bold text-gray-900 mb-3 hover:text-cyan-600 transition-colors">
                                <a href="{{ route('blogs.show', $blog->slug) }}">
                                    {{ $blog->title }}
                                </a>
                            </h2>

                            <!-- Excerpt -->
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($blog->content), 150) }}
                            </p>

                            <!-- Read More Button -->
                            <a href="{{ route('blogs.show', $blog->slug) }}" 
                               class="inline-flex items-center text-cyan-600 hover:text-cyan-700 font-semibold group">
                                Read More
                                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </a>

                            <!-- Comment Count -->
                            <div class="mt-4 pt-4 border-t border-gray-200 flex items-center text-gray-500">
                                <i class="fas fa-comments text-cyan-600 mr-2"></i>
                                <span class="text-sm">{{ $blog->approvedComments->count() }} Q&A</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $blogs->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                    <i class="fas fa-blog text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">No Blogs Yet</h3>
                <p class="text-gray-600">Check back soon for insightful articles!</p>
            </div>
        @endif
    </div>
</div>
@endsection
