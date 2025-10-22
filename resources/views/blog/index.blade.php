@extends('layouts.main')

@section('title', 'Blog - Study Abroad Stories & Tips')

@section('content')
<div class="bg-gray-50 py-8">
    <!-- Header -->
    <div class="gradient-primary mb-8 rounded-2xl">
        <div class="container mx-auto px-4 py-12 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Blog</h1>
            <p class="text-xl text-white/90 max-w-3xl mx-auto">
                Student stories, application tips, and insights from the study abroad journey.
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4">
        <!-- Categories -->
        <div class="mb-8">
            <div class="flex flex-wrap gap-3">
                <button class="category-filter active px-6 py-2 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 smooth-transition" data-category="all">
                    All Posts
                </button>
                <button class="category-filter px-6 py-2 bg-gray-200 text-gray-700 rounded-full font-semibold hover:bg-gray-300 smooth-transition" data-category="Application Tips">
                    Application Tips
                </button>
                <button class="category-filter px-6 py-2 bg-gray-200 text-gray-700 rounded-full font-semibold hover:bg-gray-300 smooth-transition" data-category="Student Stories">
                    Student Stories
                </button>
                <button class="category-filter px-6 py-2 bg-gray-200 text-gray-700 rounded-full font-semibold hover:bg-gray-300 smooth-transition" data-category="Scholarships">
                    Scholarships
                </button>
                <button class="category-filter px-6 py-2 bg-gray-200 text-gray-700 rounded-full font-semibold hover:bg-gray-300 smooth-transition" data-category="Life Abroad">
                    Life Abroad
                </button>
            </div>
        </div>

        <!-- Featured Post -->
        <article class="bg-white rounded-xl shadow-lg overflow-hidden mb-8 blog-post" data-category="Student Stories">
            <div class="grid md:grid-cols-2 gap-0">
                <img src="https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-full object-cover" alt="MIT Campus">
                <div class="p-8">
                    <div class="flex items-center space-x-4 text-sm text-gray-500 mb-3">
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full font-semibold">Student Stories</span>
                        <span><i class="far fa-calendar mr-1"></i>Oct 15, 2025</span>
                        <span><i class="far fa-clock mr-1"></i>8 min read</span>
                    </div>
                    <h2 class="text-3xl font-bold mb-3">From Dhaka to MIT: My Journey to Study Computer Science</h2>
                    <p class="text-gray-600 mb-4 see-more-text line-clamp-3">
                        I still remember the day I received my MIT acceptance email. It was 2:47 AM in Dhaka, and I had stayed up refreshing my email every five minutes. The journey from a public school in Dhaka to one of the world's top universities wasn't easy, but it taught me invaluable lessons about perseverance, strategic planning, and believing in yourself even when the odds seem impossible. In this post, I'll share the exact steps I took, the mistakes I made, and the resources that helped me achieve my dream.
                    </p>
                    <button class="see-more-btn text-blue-600 hover:underline font-semibold mb-4">Read full story →</button>
                    <div class="flex items-center">
                        <img src="https://i.pravatar.cc/150?img=12" class="w-10 h-10 rounded-full mr-3" alt="Author">
                        <div>
                            <div class="font-semibold">Rafiq Ahmed</div>
                            <div class="text-sm text-gray-500">MIT Computer Science '23</div>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <!-- Blog Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Post 1 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover blog-post" data-category="Application Tips">
                <img src="https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Post">
                <div class="p-6">
                    <div class="flex items-center space-x-3 text-sm text-gray-500 mb-3">
                        <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 rounded-full font-semibold text-xs">Application Tips</span>
                        <span><i class="far fa-calendar mr-1"></i>Oct 10, 2025</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">How to Write a Winning Statement of Purpose</h3>
                    <p class="text-gray-600 mb-3 text-sm see-more-text line-clamp-3">
                        Your SOP is your chance to tell admissions committees who you are beyond grades and test scores. Learn the structure, common mistakes, and what makes a memorable statement.
                    </p>
                    <button class="see-more-btn text-blue-600 hover:underline font-semibold text-sm">Read more →</button>
                    <div class="flex items-center mt-4 pt-4 border-t">
                        <img src="https://i.pravatar.cc/150?img=25" class="w-8 h-8 rounded-full mr-2" alt="Author">
                        <div class="text-sm">
                            <div class="font-semibold">Sarah Khan</div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Post 2 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover blog-post" data-category="Scholarships">
                <img src="https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Post">
                <div class="p-6">
                    <div class="flex items-center space-x-3 text-sm text-gray-500 mb-3">
                        <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full font-semibold text-xs">Scholarships</span>
                        <span><i class="far fa-calendar mr-1"></i>Oct 8, 2025</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Top 10 Fully-Funded Scholarships for Bangladeshi Students</h3>
                    <p class="text-gray-600 mb-3 text-sm see-more-text line-clamp-3">
                        Comprehensive guide to scholarships covering tuition, living expenses, and travel. Includes Fulbright, Commonwealth, DAAD, and university-specific opportunities with deadlines.
                    </p>
                    <button class="see-more-btn text-blue-600 hover:underline font-semibold text-sm">Read more →</button>
                    <div class="flex items-center mt-4 pt-4 border-t">
                        <img src="https://i.pravatar.cc/150?img=33" class="w-8 h-8 rounded-full mr-2" alt="Author">
                        <div class="text-sm">
                            <div class="font-semibold">Nasir Uddin</div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Post 3 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover blog-post" data-category="Life Abroad">
                <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="US Campus Life">
                <div class="p-6">
                    <div class="flex items-center space-x-3 text-sm text-gray-500 mb-3">
                        <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full font-semibold text-xs">Life Abroad</span>
                        <span><i class="far fa-calendar mr-1"></i>Oct 5, 2025</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">First Month in the US: What I Wish I Knew Before Arriving</h3>
                    <p class="text-gray-600 mb-3 text-sm see-more-text line-clamp-3">
                        From opening a bank account to navigating the grocery store, here's everything that surprised me during my first 30 days as an international student in America.
                    </p>
                    <button class="see-more-btn text-blue-600 hover:underline font-semibold text-sm">Read more →</button>
                    <div class="flex items-center mt-4 pt-4 border-t">
                        <img src="https://i.pravatar.cc/150?img=47" class="w-8 h-8 rounded-full mr-2" alt="Author">
                        <div class="text-sm">
                            <div class="font-semibold">Priya Das</div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Post 4 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover blog-post" data-category="Application Tips">
                <img src="https://images.unsplash.com/photo-1517842645767-c639042777db?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Post">
                <div class="p-6">
                    <div class="flex items-center space-x-3 text-sm text-gray-500 mb-3">
                        <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 rounded-full font-semibold text-xs">Application Tips</span>
                        <span><i class="far fa-calendar mr-1"></i>Oct 1, 2025</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">GRE vs GMAT: Which Test Should You Take?</h3>
                    <p class="text-gray-600 mb-3 text-sm see-more-text line-clamp-3">
                        Detailed comparison of both exams including format, difficulty, acceptance, and preparation strategies. Find out which test aligns with your strengths and target programs.
                    </p>
                    <button class="see-more-btn text-blue-600 hover:underline font-semibold text-sm">Read more →</button>
                    <div class="flex items-center mt-4 pt-4 border-t">
                        <img src="https://i.pravatar.cc/150?img=15" class="w-8 h-8 rounded-full mr-2" alt="Author">
                        <div class="text-sm">
                            <div class="font-semibold">Kamal Hossain</div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Post 5 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover blog-post" data-category="Student Stories">
                <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Post">
                <div class="p-6">
                    <div class="flex items-center space-x-3 text-sm text-gray-500 mb-3">
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full font-semibold text-xs">Student Stories</span>
                        <span><i class="far fa-calendar mr-1"></i>Sep 28, 2025</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">How I Got Into Oxford with a 3.4 GPA</h3>
                    <p class="text-gray-600 mb-3 text-sm see-more-text line-clamp-3">
                        Proof that GPA isn't everything. My application strategy focused on research experience, impactful recommendations, and a compelling personal narrative. Here's exactly what worked.
                    </p>
                    <button class="see-more-btn text-blue-600 hover:underline font-semibold text-sm">Read more →</button>
                    <div class="flex items-center mt-4 pt-4 border-t">
                        <img src="https://i.pravatar.cc/150?img=28" class="w-8 h-8 rounded-full mr-2" alt="Author">
                        <div class="text-sm">
                            <div class="font-semibold">Anika Rahman</div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Post 6 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover blog-post" data-category="Life Abroad">
                <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Post">
                <div class="p-6">
                    <div class="flex items-center space-x-3 text-sm text-gray-500 mb-3">
                        <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full font-semibold text-xs">Life Abroad</span>
                        <span><i class="far fa-calendar mr-1"></i>Sep 25, 2025</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Finding Halal Food in College Towns: A Complete Guide</h3>
                    <p class="text-gray-600 mb-3 text-sm see-more-text line-clamp-3">
                        Campus dining options, local restaurants, grocery shopping tips, and how to connect with the Muslim community. Plus apps and resources for halal certification.
                    </p>
                    <button class="see-more-btn text-blue-600 hover:underline font-semibold text-sm">Read more →</button>
                    <div class="flex items-center mt-4 pt-4 border-t">
                        <img src="https://i.pravatar.cc/150?img=41" class="w-8 h-8 rounded-full mr-2" alt="Author">
                        <div class="text-sm">
                            <div class="font-semibold">Ibrahim Khan</div>
                        </div>
                    </div>
                </div>
            </article>
        </div>

        <!-- CTA Section -->
        <div class="gradient-primary rounded-2xl p-8 text-center">
            <h2 class="text-3xl font-bold mb-4 text-white">Want to Share Your Story?</h2>
            <p class="mb-6 max-w-2xl mx-auto text-white/90">
                Help future students by sharing your experiences, tips, and lessons learned from your study abroad journey.
            </p>
            <a href="{{ route('contribute') }}" class="inline-block px-8 py-3 bg-white text-blue-600 font-bold rounded-lg smooth-transition shadow-lg hover:shadow-xl hover:bg-blue-50">
                Contribute a Post
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Category filtering
    const categoryFilters = document.querySelectorAll('.category-filter');
    const blogPosts = document.querySelectorAll('.blog-post');
    
    categoryFilters.forEach(btn => {
        btn.addEventListener('click', function() {
            // Update active state
            categoryFilters.forEach(b => {
                b.classList.remove('active', 'bg-blue-600', 'text-white');
                b.classList.add('bg-gray-200', 'text-gray-700');
            });
            this.classList.add('active', 'bg-blue-600', 'text-white');
            this.classList.remove('bg-gray-200', 'text-gray-700');
            
            const category = this.dataset.category;
            
            blogPosts.forEach(post => {
                if (category === 'all' || post.dataset.category === category) {
                    post.style.display = 'block';
                } else {
                    post.style.display = 'none';
                }
            });
        });
    });

    // See more functionality
    document.querySelectorAll('.see-more-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const text = this.previousElementSibling;
            if (text.classList.contains('line-clamp-3')) {
                text.classList.remove('line-clamp-3');
                this.textContent = 'See less';
            } else {
                text.classList.add('line-clamp-3');
                this.textContent = 'Read more →';
            }
        });
    });
</script>
@endpush
@endsection
