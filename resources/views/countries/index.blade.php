@extends('layouts.main')

@section('title', 'Country Guides - Study Abroad')

@section('content')
<div style="background: transparent; min-height: 100vh;" class="py-8">
    <!-- Header -->
    <div class="gradient-panel mb-8">
        <div class="container mx-auto px-4 py-12 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4" style="color: #e6f1f3;">Country Guides</h1>
            <p class="text-xl max-w-3xl mx-auto" style="color: #99a9ad;">
                Everything you need to know about studying abroad - living costs, culture, language, visa requirements, and more.
            </p>
        </div>
    </div>

    <div class="container mx-auto px-4">
        <!-- Search Bar -->
        <div class="mb-8">
            <div style="background: rgba(15, 32, 37, 0.8); border: 1px solid rgba(255, 255, 255, 0.06); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);" class="rounded-xl p-6">
                <div class="flex items-center space-x-4">
                    <i class="fas fa-search text-xl" style="color: #99a9ad;"></i>
                    <input type="text" 
                           id="countrySearch" 
                           placeholder="Search countries..." 
                           style="background: transparent; border: none; color: #e6f1f3; flex: 1; outline: none; font-size: 1.125rem;"
                           class="flex-1">
                </div>
            </div>
        </div>

        <!-- Region Filters -->
        <div class="mb-8">
            <div class="flex flex-wrap gap-3">
                <button class="region-filter active px-6 py-2 gradient-primary text-white rounded-full font-semibold smooth-transition" data-region="all">
                    All Regions
                </button>
                <button class="region-filter px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 smooth-transition" data-region="North America">
                    North America
                </button>
                <button class="region-filter px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 smooth-transition" data-region="Europe">
                    Europe
                </button>
                <button class="region-filter px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 smooth-transition" data-region="Asia-Pacific">
                    Asia-Pacific
                </button>
                <button class="region-filter px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 smooth-transition" data-region="Middle East">
                    Middle East
                </button>
                <button class="region-filter px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 smooth-transition" data-region="Latin America">
                    Latin America
                </button>
            </div>
        </div>

        <!-- Countries Grid -->
        <div id="countriesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- USA -->
            <article class="country-card rounded-xl shadow-lg overflow-hidden card-hover" style="background: rgba(15, 34, 39, 0.9); border: 1px solid rgba(255, 255, 255, 0.06);" data-region="North America" data-name="United States">
                <img src="https://images.unsplash.com/photo-1485738422979-f5c462d49f74?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="United States">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-2xl font-bold" style="color: #e6f1f3;">United States</h3>
                        <span class="text-sm" style="color: #99a9ad;">North America</span>
                    </div>
                    <p class="mb-4" style="color: #99a9ad;">
                        Home to world's top universities. Diverse programs, cutting-edge research, extensive scholarship opportunities.
                    </p>
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <div class="text-sm">
                            <span style="color: #99a9ad;">Universities:</span>
                            <span class="font-semibold ml-1" style="color: #e6f1f3;">150+</span>
                        </div>
                        <div class="text-sm">
                            <span style="color: #99a9ad;">Living Cost:</span>
                            <span class="font-semibold ml-1" style="color: #e6f1f3;">$$$$</span>
                        </div>
                    </div>
                    <a href="{{ route('countries.show', 'united-states') }}" class="block w-full text-center px-4 py-2 gradient-primary text-white font-semibold rounded-lg smooth-transition shadow-lg hover:shadow-xl">
                        Explore Guide
                    </a>
                </div>
            </article>

            <!-- UK -->
            <article class="country-card rounded-xl shadow-lg overflow-hidden card-hover" style="background: rgba(15, 34, 39, 0.9); border: 1px solid rgba(255, 255, 255, 0.06);" data-region="Europe" data-name="United Kingdom">
                <img src="https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="United Kingdom">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-2xl font-bold" style="color: #e6f1f3;">United Kingdom</h3>
                        <span class="text-sm" style="color: #99a9ad;">Europe</span>
                    </div>
                    <p class="mb-4" style="color: #99a9ad;">
                        Historic universities with global reputation. Shorter degree programs, rich cultural heritage.
                    </p>
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <div class="text-sm">
                            <span style="color: #99a9ad;">Universities:</span>
                            <span class="font-semibold ml-1" style="color: #e6f1f3;">130+</span>
                        </div>
                        <div class="text-sm">
                            <span style="color: #99a9ad;">Living Cost:</span>
                            <span class="font-semibold ml-1" style="color: #e6f1f3;">$$$</span>
                        </div>
                    </div>
                    <a href="{{ route('countries.show', 'united-kingdom') }}" class="block w-full text-center px-4 py-2 gradient-primary text-white font-semibold rounded-lg smooth-transition shadow-lg hover:shadow-xl">
                        Explore Guide
                    </a>
                </div>
            </article>

            <!-- Canada -->
            <article class="country-card rounded-xl shadow-lg overflow-hidden card-hover" style="background: rgba(15, 34, 39, 0.9); border: 1px solid rgba(255, 255, 255, 0.06);" data-region="North America" data-name="Canada">
                <img src="https://images.unsplash.com/photo-1503614472-8c93d56e92ce?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Canada">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-2xl font-bold" style="color: #e6f1f3;">Canada</h3>
                        <span class="text-sm" style="color: #99a9ad;">North America</span>
                    </div>
                    <p class="mb-4" style="color: #99a9ad;">
                        Welcoming immigration policies, affordable tuition, high quality of life and safe cities.
                    </p>
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <div class="text-sm">
                            <span style="color: #99a9ad;">Universities:</span>
                            <span class="font-semibold ml-1" style="color: #e6f1f3;">90+</span>
                        </div>
                        <div class="text-sm">
                            <span style="color: #99a9ad;">Living Cost:</span>
                            <span class="font-semibold ml-1" style="color: #e6f1f3;">$$$</span>
                        </div>
                    </div>
                    <a href="{{ route('countries.show', 'canada') }}" class="block w-full text-center px-4 py-2 gradient-primary text-white font-semibold rounded-lg smooth-transition shadow-lg hover:shadow-xl">
                        Explore Guide
                    </a>
                </div>
            </article>

            <!-- Australia -->
            <article class="country-card rounded-xl shadow-lg overflow-hidden card-hover" style="background: rgba(15, 34, 39, 0.9); border: 1px solid rgba(255, 255, 255, 0.06);" data-region="Asia-Pacific" data-name="Australia">
                <img src="https://images.unsplash.com/photo-1523482580672-f109ba8cb9be?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Australia">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-2xl font-bold" style="color: #e6f1f3;">Australia</h3>
                        <span class="text-sm" style="color: #99a9ad;">Asia-Pacific</span>
                    </div>
                    <p class="mb-4" style="color: #99a9ad;">
                        Work while studying, post-study work visa, excellent weather and lifestyle balance.
                    </p>
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <div class="text-sm">
                            <span style="color: #99a9ad;">Universities:</span>
                            <span class="font-semibold ml-1" style="color: #e6f1f3;">40+</span>
                        </div>
                        <div class="text-sm">
                            <span style="color: #99a9ad;">Living Cost:</span>
                            <span class="font-semibold ml-1" style="color: #e6f1f3;">$$$</span>
                        </div>
                    </div>
                    <a href="{{ route('countries.show', 'australia') }}" class="block w-full text-center px-4 py-2 gradient-primary text-white font-semibold rounded-lg smooth-transition shadow-lg hover:shadow-xl">
                        Explore Guide
                    </a>
                </div>
            </article>

            <!-- Germany -->
            <article class="country-card rounded-xl shadow-lg overflow-hidden card-hover" style="background: rgba(15, 34, 39, 0.9); border: 1px solid rgba(255, 255, 255, 0.06);" data-region="Europe" data-name="Germany">
                <img src="https://images.unsplash.com/photo-1467269204594-9661b134dd2b?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Germany">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-2xl font-bold" style="color: #e6f1f3;">Germany</h3>
                        <span class="text-sm" style="color: #99a9ad;">Europe</span>
                    </div>
                    <p class="mb-4" style="color: #99a9ad;">
                        Tuition-free public universities, strong engineering programs, central European location.
                    </p>
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <div class="text-sm">
                            <span style="color: #99a9ad;">Universities:</span>
                            <span class="font-semibold ml-1" style="color: #e6f1f3;">100+</span>
                        </div>
                        <div class="text-sm">
                            <span style="color: #99a9ad;">Living Cost:</span>
                            <span class="font-semibold ml-1" style="color: #e6f1f3;">$$</span>
                        </div>
                    </div>
                    <a href="{{ route('countries.show', 'germany') }}" class="block w-full text-center px-4 py-2 gradient-primary text-white font-semibold rounded-lg smooth-transition shadow-lg hover:shadow-xl">
                        Explore Guide
                    </a>
                </div>
            </article>

            <!-- Japan -->
            <article class="country-card rounded-xl shadow-lg overflow-hidden card-hover" style="background: rgba(15, 34, 39, 0.9); border: 1px solid rgba(255, 255, 255, 0.06);" data-region="Asia-Pacific" data-name="Japan">
                <img src="https://images.unsplash.com/photo-1492571350019-22de08371fd3?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Japan">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-2xl font-bold" style="color: #e6f1f3;">Japan</h3>
                        <span class="text-sm" style="color: #99a9ad;">Asia-Pacific</span>
                    </div>
                    <p class="mb-4" style="color: #99a9ad;">
                        Leading technology research, MEXT scholarships, unique cultural experience and safety.
                    </p>
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <div class="text-sm">
                            <span style="color: #99a9ad;">Universities:</span>
                            <span class="font-semibold ml-1" style="color: #e6f1f3;">80+</span>
                        </div>
                        <div class="text-sm">
                            <span style="color: #99a9ad;">Living Cost:</span>
                            <span class="font-semibold ml-1" style="color: #e6f1f3;">$$$</span>
                        </div>
                    </div>
                    <a href="{{ route('countries.show', 'japan') }}" class="block w-full text-center px-4 py-2 gradient-primary text-white font-semibold rounded-lg smooth-transition shadow-lg hover:shadow-xl">
                        Explore Guide
                    </a>
                </div>
            </article>
        </div>

        <!-- No Results Message -->
        <div id="noResults" class="hidden text-center py-12">
            <i class="fas fa-search text-6xl mb-4" style="color: rgba(153, 169, 173, 0.3);"></i>
            <p class="text-xl" style="color: #99a9ad;">No countries found matching your criteria</p>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Search functionality
    const searchInput = document.getElementById('countrySearch');
    const countryCards = document.querySelectorAll('.country-card');
    const noResults = document.getElementById('noResults');
    const regionFilters = document.querySelectorAll('.region-filter');
    let activeRegion = 'all';

    searchInput.addEventListener('input', filterCountries);
    
    regionFilters.forEach(btn => {
        btn.addEventListener('click', function() {
            // Update active state
            regionFilters.forEach(b => {
                b.classList.remove('active', 'gradient-primary', 'text-white');
                b.classList.add('bg-gray-200', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
            });
            this.classList.add('active', 'gradient-primary', 'text-white');
            this.classList.remove('bg-gray-200', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
            
            activeRegion = this.dataset.region;
            filterCountries();
        });
    });

    function filterCountries() {
        const searchTerm = searchInput.value.toLowerCase();
        let visibleCount = 0;

        countryCards.forEach(card => {
            const name = card.dataset.name.toLowerCase();
            const region = card.dataset.region;
            const matchesSearch = name.includes(searchTerm);
            const matchesRegion = activeRegion === 'all' || region === activeRegion;

            if (matchesSearch && matchesRegion) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Show/hide no results message
        if (visibleCount === 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
    }
</script>
@endsection
@endsection
