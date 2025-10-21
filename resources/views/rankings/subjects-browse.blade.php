@extends('layouts.main')

@section('title', 'Browse Rankings by Subject - Bangladeshis Beyond Border')

@section('content')
    <!-- Header -->
    <header class="gradient-primary text-white shadow-lg">
        <div class="container mx-auto px-4 py-8">
            <div class="flex justify-between items-center">
                <div class="animate__animated animate__fadeInLeft">
                    <h1 class="text-4xl font-bold">QS World University Rankings by Subject</h1>
                    <p class="mt-2 text-emerald-100 text-lg">{{ $subjects->count() }} subjects across 5 broad areas</p>
                </div>
                <div class="flex space-x-4 animate__animated animate__fadeInRight">
                    <a href="{{ route('rankings.index') }}" class="px-6 py-3 bg-white bg-opacity-20 backdrop-blur-md rounded-xl hover:bg-opacity-30 transition border border-white border-opacity-30">
                        <i class="fas fa-trophy mr-2"></i> Overall Rankings
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <!-- Search Bar -->
        <div class="mb-8">
            <div class="max-w-3xl mx-auto">
                <div class="relative">
                    <input 
                        type="text" 
                        id="subjectSearch" 
                        placeholder="Search for a subject (e.g., Computer Science, Medicine, Engineering...)"
                        class="w-full px-6 py-4 text-lg rounded-lg shadow-lg border-2 focus:outline-none"
                        style="background: rgba(15, 32, 37, 0.8); border-color: rgba(56, 189, 248, 0.3); color: #e6f1f3; backdrop-filter: blur(10px);"
                    >
                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                        <i class="fas fa-search text-xl" style="color: #38bdf8;"></i>
                    </div>
                </div>
                <div id="searchResults" class="mt-2 rounded-lg shadow-lg hidden max-h-96 overflow-y-auto" style="background: rgba(15, 32, 37, 0.95); backdrop-filter: blur(10px); border: 1px solid rgba(56, 189, 248, 0.3);"></div>
            </div>
        </div>

        <!-- Quick Navigation -->
        <div class="rounded-lg shadow-md p-6 mb-8" style="background: rgba(15, 32, 37, 0.8); backdrop-filter: blur(10px);">
            <h3 class="text-xl font-bold mb-4 flex items-center" style="color: #e6f1f3;">
                <i class="fas fa-compass mr-2" style="color: #38bdf8;"></i>
                Browse by Broad Subject Area
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <a href="#arts-humanities" class="flex items-center space-x-3 p-4 rounded-lg transition" style="background: rgba(17, 51, 58, 0.4); border: 1px solid rgba(56, 189, 248, 0.2);">
                    <span class="text-3xl">🎨</span>
                    <div>
                        <div class="font-semibold" style="color: #e6f1f3;">Arts & Humanities</div>
                        <div class="text-sm" style="color: #99a9ad;">11 subjects</div>
                    </div>
                </a>
                <a href="#engineering-technology" class="flex items-center space-x-3 p-4 rounded-lg transition" style="background: rgba(17, 51, 58, 0.4); border: 1px solid rgba(56, 189, 248, 0.2);">
                    <span class="text-3xl">⚙️</span>
                    <div>
                        <div class="font-semibold" style="color: #e6f1f3;">Engineering</div>
                        <div class="text-sm" style="color: #99a9ad;">7 subjects</div>
                    </div>
                </a>
                <a href="#life-sciences" class="flex items-center space-x-3 p-4 rounded-lg transition" style="background: rgba(17, 51, 58, 0.4); border: 1px solid rgba(56, 189, 248, 0.2);">
                    <span class="text-3xl">🏥</span>
                    <div>
                        <div class="font-semibold" style="color: #e6f1f3;">Life Sciences</div>
                        <div class="text-sm" style="color: #99a9ad;">9 subjects</div>
                    </div>
                </a>
                <a href="#natural-sciences" class="flex items-center space-x-3 p-4 rounded-lg transition" style="background: rgba(17, 51, 58, 0.4); border: 1px solid rgba(56, 189, 248, 0.2);">
                    <span class="text-3xl">🔬</span>
                    <div>
                        <div class="font-semibold" style="color: #e6f1f3;">Natural Sciences</div>
                        <div class="text-sm" style="color: #99a9ad;">9 subjects</div>
                    </div>
                </a>
                <a href="#social-sciences" class="flex items-center space-x-3 p-4 rounded-lg transition" style="background: rgba(17, 51, 58, 0.4); border: 1px solid rgba(56, 189, 248, 0.2);">
                    <span class="text-3xl">📊</span>
                    <div>
                        <div class="font-semibold" style="color: #e6f1f3;">Social Sciences</div>
                        <div class="text-sm" style="color: #99a9ad;">15 subjects</div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Arts & Humanities -->
        <div id="arts-humanities" class="category-section mb-12">
            <div class="rounded-t-lg p-6" style="background: linear-gradient(135deg, #127083 0%, #38bdf8 100%); backdrop-filter: blur(10px);">
                <h2 class="text-3xl font-bold flex items-center" style="color: #ffffff;">
                    <span class="text-4xl mr-4">🎨</span>
                    Arts & Humanities
                </h2>
                <p class="mt-2" style="color: rgba(255, 255, 255, 0.8);">Explore rankings in creative and humanistic disciplines</p>
            </div>
            <div class="rounded-b-lg shadow-md p-6" style="background: rgba(15, 32, 37, 0.8); backdrop-filter: blur(10px);">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($subjects->where('category', 'specific')->filter(function($s) {
                        return in_array($s->slug, ['archaeology', 'architecture', 'art-design', 'classics-ancient-history', 
                                'english-language-literature', 'history', 'linguistics', 'modern-languages', 
                                'performing-arts', 'philosophy', 'theology']);
                    }) as $subject)
                        <a href="{{ route('rankings.by-subject', $subject->slug) }}" class="subject-card block group">
                            <div class="rounded-lg p-4 h-full border-2 transition" style="background: rgba(17, 51, 58, 0.4); border-color: rgba(56, 189, 248, 0.2);">
                                <div class="text-center">
                                    <div class="text-3xl mb-2">{{ $subject->icon }}</div>
                                    <h3 class="text-sm font-semibold transition" style="color: #e6f1f3;">
                                        {{ $subject->name }}
                                    </h3>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Engineering & Technology -->
        <div id="engineering-technology" class="category-section mb-12">
            <div class="rounded-t-lg p-6" style="background: linear-gradient(135deg, #127083 0%, #38bdf8 100%); backdrop-filter: blur(10px);">
                <h2 class="text-3xl font-bold flex items-center" style="color: #ffffff;">
                    <span class="text-4xl mr-4">⚙️</span>
                    Engineering & Technology
                </h2>
                <p class="mt-2" style="color: rgba(255, 255, 255, 0.8);">Discover leading institutions in engineering and tech fields</p>
            </div>
            <div class="rounded-b-lg shadow-md p-6" style="background: rgba(15, 32, 37, 0.8); backdrop-filter: blur(10px);">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($subjects->where('category', 'specific')->filter(function($s) {
                        return in_array($s->slug, ['computer-science', 'chemical-engineering', 'civil-engineering', 
                                'electrical-engineering', 'mechanical-engineering', 'mining-engineering', 'petroleum-engineering']);
                    }) as $subject)
                        <a href="{{ route('rankings.by-subject', $subject->slug) }}" class="subject-card block group">
                            <div class="rounded-lg p-4 h-full border-2 transition" style="background: rgba(17, 51, 58, 0.4); border-color: rgba(56, 189, 248, 0.2);">
                                <div class="text-center">
                                    <div class="text-3xl mb-2">{{ $subject->icon }}</div>
                                    <h3 class="text-sm font-semibold transition" style="color: #e6f1f3;">
                                        {{ $subject->name }}
                                    </h3>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Life Sciences & Medicine -->
        <div id="life-sciences" class="category-section mb-12">
            <div class="rounded-t-lg p-6" style="background: linear-gradient(135deg, #127083 0%, #38bdf8 100%); backdrop-filter: blur(10px);">
                <h2 class="text-3xl font-bold flex items-center" style="color: #ffffff;">
                    <span class="text-4xl mr-4">🏥</span>
                    Life Sciences & Medicine
                </h2>
                <p class="mt-2" style="color: rgba(255, 255, 255, 0.8);">Find top universities in health and biological sciences</p>
            </div>
            <div class="rounded-b-lg shadow-md p-6" style="background: rgba(15, 32, 37, 0.8); backdrop-filter: blur(10px);">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($subjects->where('category', 'specific')->filter(function($s) {
                        return in_array($s->slug, ['agriculture-forestry', 'anatomy-physiology', 'biological-sciences', 
                                'dentistry', 'medicine', 'nursing', 'pharmacy', 'psychology', 'veterinary-science']);
                    }) as $subject)
                        <a href="{{ route('rankings.by-subject', $subject->slug) }}" class="subject-card block group">
                            <div class="rounded-lg p-4 h-full border-2 transition" style="background: rgba(17, 51, 58, 0.4); border-color: rgba(56, 189, 248, 0.2);">
                                <div class="text-center">
                                    <div class="text-3xl mb-2">{{ $subject->icon }}</div>
                                    <h3 class="text-sm font-semibold transition" style="color: #e6f1f3;">
                                        {{ $subject->name }}
                                    </h3>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Natural Sciences -->
        <div id="natural-sciences" class="category-section mb-12">
            <div class="rounded-t-lg p-6" style="background: linear-gradient(135deg, #127083 0%, #38bdf8 100%); backdrop-filter: blur(10px);">
                <h2 class="text-3xl font-bold flex items-center" style="color: #ffffff;">
                    <span class="text-4xl mr-4">🔬</span>
                    Natural Sciences
                </h2>
                <p class="mt-2" style="color: rgba(255, 255, 255, 0.8);">Explore rankings in physical and natural sciences</p>
            </div>
            <div class="rounded-b-lg shadow-md p-6" style="background: rgba(15, 32, 37, 0.8); backdrop-filter: blur(10px);">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($subjects->where('category', 'specific')->filter(function($s) {
                        return in_array($s->slug, ['chemistry', 'earth-marine-sciences', 'environmental-sciences', 
                                'geography', 'geology', 'geophysics', 'materials-science', 'mathematics', 'physics-astronomy']);
                    }) as $subject)
                        <a href="{{ route('rankings.by-subject', $subject->slug) }}" class="subject-card block group">
                            <div class="rounded-lg p-4 h-full border-2 transition" style="background: rgba(17, 51, 58, 0.4); border-color: rgba(56, 189, 248, 0.2);">
                                <div class="text-center">
                                    <div class="text-3xl mb-2">{{ $subject->icon }}</div>
                                    <h3 class="text-sm font-semibold transition" style="color: #e6f1f3;">
                                        {{ $subject->name }}
                                    </h3>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Social Sciences & Management -->
        <div id="social-sciences" class="category-section mb-12">
            <div class="rounded-t-lg p-6" style="background: linear-gradient(135deg, #127083 0%, #38bdf8 100%); backdrop-filter: blur(10px);">
                <h2 class="text-3xl font-bold flex items-center" style="color: #ffffff;">
                    <span class="text-4xl mr-4">📊</span>
                    Social Sciences & Management
                </h2>
                <p class="mt-2" style="color: rgba(255, 255, 255, 0.8);">Rankings in business, social sciences, and management</p>
            </div>
            <div class="rounded-b-lg shadow-md p-6" style="background: rgba(15, 32, 37, 0.8); backdrop-filter: blur(10px);">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($subjects->where('category', 'specific')->filter(function($s) {
                        return in_array($s->slug, ['accounting-finance', 'anthropology', 'business-management', 
                                'communication-media', 'development-studies', 'economics', 'education', 
                                'hospitality-tourism', 'law', 'library-information', 'politics', 'social-policy', 
                                'sociology', 'sports-science', 'statistics']);
                    }) as $subject)
                        <a href="{{ route('rankings.by-subject', $subject->slug) }}" class="subject-card block group">
                            <div class="rounded-lg p-4 h-full border-2 transition" style="background: rgba(17, 51, 58, 0.4); border-color: rgba(56, 189, 248, 0.2);">
                                <div class="text-center">
                                    <div class="text-3xl mb-2">{{ $subject->icon }}</div>
                                    <h3 class="text-sm font-semibold transition" style="color: #e6f1f3;">
                                        {{ $subject->name }}
                                    </h3>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="mt-12 rounded-lg p-8" style="background: linear-gradient(135deg, rgba(15, 32, 37, 0.95), rgba(17, 51, 58, 0.95)); backdrop-filter: blur(10px); border: 1px solid rgba(56, 189, 248, 0.2);">
            <div class="grid md:grid-cols-4 gap-6 text-center">
                <div>
                    <div class="text-4xl font-bold" style="color: #38bdf8;">{{ $subjects->where('category', 'broad')->count() }}</div>
                    <div class="mt-2" style="color: #99a9ad;">Broad Subject Areas</div>
                </div>
                <div>
                    <div class="text-4xl font-bold" style="color: #38bdf8;">{{ $subjects->where('category', 'specific')->count() }}</div>
                    <div class="mt-2" style="color: #99a9ad;">Specific Subjects</div>
                </div>
                <div>
                    <div class="text-4xl font-bold" style="color: #38bdf8;">600+</div>
                    <div class="mt-2" style="color: #99a9ad;">Universities Ranked</div>
                </div>
                <div>
                    <div class="text-4xl font-bold" style="color: #38bdf8;">100+</div>
                    <div class="mt-2" style="color: #99a9ad;">Countries Covered</div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    <style>
        .subject-card {
            transition: all 0.3s ease;
        }
        .subject-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }
        .subject-card:hover > div {
            border-color: rgba(56, 189, 248, 0.6) !important;
            background: rgba(56, 189, 248, 0.15) !important;
        }
        .category-section {
            scroll-margin-top: 100px;
        }
        .search-highlight {
            background-color: rgba(56, 189, 248, 0.3);
            padding: 2px 4px;
            border-radius: 3px;
            color: #38bdf8;
            font-weight: 600;
        }
        #subjectSearch::placeholder {
            color: #99a9ad;
            opacity: 0.7;
        }
        #subjectSearch:focus {
            border-color: #38bdf8 !important;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.1);
        }
    </style>

    <script>
        // Real-time subject search
        const searchInput = document.getElementById('subjectSearch');
        const searchResults = document.getElementById('searchResults');
        
        const subjects = {!! json_encode($subjects) !!};
        
        searchInput.addEventListener('input', function(e) {
            const query = e.target.value.toLowerCase().trim();
            
            if (query.length < 2) {
                searchResults.classList.add('hidden');
                return;
            }
            
            const filtered = subjects.filter(subject => 
                subject.name.toLowerCase().includes(query)
            );
            
            if (filtered.length === 0) {
                searchResults.innerHTML = '<div class="p-4 text-center" style="color: #99a9ad;">No subjects found</div>';
                searchResults.classList.remove('hidden');
                return;
            }
            
            let html = '<div class="divide-y" style="border-color: rgba(56, 189, 248, 0.2);">';
            filtered.forEach(subject => {
                const highlightedName = subject.name.replace(
                    new RegExp(query, 'gi'), 
                    match => `<span class="search-highlight">${match}</span>`
                );
                
                html += `
                    <a href="/rankings/subject/${subject.slug}" class="block p-4 transition" style="color: #e6f1f3;" onmouseover="this.style.background='rgba(56, 189, 248, 0.1)'" onmouseout="this.style.background='transparent'">
                        <div class="flex items-center space-x-3">
                            <span class="text-2xl">${subject.icon}</span>
                            <div>
                                <div class="font-semibold">${highlightedName}</div>
                                <div class="text-xs" style="color: #99a9ad;">${subject.category === 'broad' ? 'Broad Subject Area' : 'Specific Subject'}</div>
                            </div>
                        </div>
                    </a>
                `;
            });
            html += '</div>';
            
            searchResults.innerHTML = html;
            searchResults.classList.remove('hidden');
        });
        
        // Click outside to close search results
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.classList.add('hidden');
            }
        });
        
        // Smooth scroll for category navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
@endpush
@endsection
