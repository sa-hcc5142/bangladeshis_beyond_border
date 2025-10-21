@extends('layouts.main')

@section('title', 'World University Rankings ' . $year)

@push('styles')
<style>
    .university-card {
        transition: all 0.3s ease;
    }
    .university-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .filter-sidebar {
        position: sticky;
        top: 100px;
    }
</style>
@endpush

@section('content')
    <!-- Header -->
    <header class="gradient-primary text-white shadow-lg rounded-2xl mb-8">
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-4xl font-bold">World University Rankings {{ $year }}</h1>
            <p class="mt-2 text-white/90">Top global universities</p>
            <div class="mt-4 flex space-x-4">
                <a href="{{ route('rankings.index') }}" class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-lg hover:bg-white/30 transition">
                    Overall Rankings
                </a>
                <a href="{{ route('subjects.browse') }}" class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-lg hover:bg-white/30 transition">
                    Rankings by Subject
                </a>
            </div>
        </div>
    </header>

    <!-- Search Bar -->
    <div class="bg-white border-b border-gray-200">
        <div class="container mx-auto px-4 py-4">
            <div class="max-w-2xl mx-auto">
                <div class="relative">
                    <input 
                        type="text" 
                        id="universitySearch" 
                        placeholder="Search universities by name..."
                        class="w-full px-4 py-3 pl-12 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:outline-none"
                    >
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <div id="searchResults" class="absolute w-full mt-2 bg-white rounded-lg shadow-lg max-h-96 overflow-y-auto hidden z-50"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Filters Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 filter-sidebar">
                    <h2 class="text-xl font-bold mb-4 flex items-center">
                        <i class="fas fa-filter mr-2 text-blue-600"></i>
                        Filters
                    </h2>
                    
                    <form method="GET" action="{{ route('rankings.index') }}" id="filterForm">
                        <!-- Year Filter -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                            <select name="year" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                                @foreach($years as $y)
                                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Region Filter -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Region</label>
                            <select name="region" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                                <option value="">All Regions</option>
                                @foreach($regions as $r)
                                    <option value="{{ $r }}" {{ request('region') == $r ? 'selected' : '' }}>{{ $r }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Country Filter -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                            <select name="country" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                                <option value="">All Countries</option>
                                @foreach($countries->groupBy('region') as $region => $regionCountries)
                                    <optgroup label="{{ $region }}">
                                        @foreach($regionCountries as $c)
                                            <option value="{{ $c->country }}" {{ request('country') == $c->country ? 'selected' : '' }}>
                                                {{ $c->country }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex space-x-2">
                            <button type="submit" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                Apply Filters
                            </button>
                            <a href="{{ route('rankings.index') }}" class="flex-1 text-center bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                                Clear
                            </a>
                        </div>
                    </form>

                    <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-info-circle text-blue-600 mr-1"></i>
                            <strong>{{ $rankings->total() }}</strong> Results
                        </p>
                    </div>
                </div>
            </div>

            <!-- Rankings List -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold">Rankings</h2>
                        <div class="text-sm text-gray-600">
                            Showing {{ $rankings->firstItem() }}-{{ $rankings->lastItem() }} of {{ $rankings->total() }}
                        </div>
                    </div>

                    <!-- Rankings Cards -->
                    <div class="space-y-4">
                        @forelse($rankings as $ranking)
                            <div class="university-card bg-white border border-gray-200 rounded-lg p-6 hover:border-blue-500">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-4">
                                            <!-- Rank Badge -->
                                            <div class="flex-shrink-0">
                                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 text-white rounded-lg flex items-center justify-center">
                                                    <div class="text-center">
                                                        <div class="text-xs font-semibold">RANK</div>
                                                        <div class="text-2xl font-bold">{{ $ranking->rank }}</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- University Info -->
                                            <div class="flex-1">
                                                <a href="{{ route('rankings.show', $ranking->university->slug) }}" class="text-xl font-bold text-blue-600 hover:text-blue-800">
                                                    {{ $ranking->university->name }}
                                                </a>
                                                <div class="flex items-center mt-1 text-gray-600">
                                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                                    <span>{{ $ranking->university->city }}, {{ $ranking->university->country }}</span>
                                                </div>
                                            </div>

                                            <!-- Overall Score -->
                                            <div class="text-center">
                                                <div class="text-3xl font-bold text-blue-600">{{ number_format($ranking->overall_score, 1) }}</div>
                                                <div class="text-xs text-gray-500">Overall Score</div>
                                            </div>
                                        </div>

                                        <!-- Metrics -->
                                        <div class="mt-4 grid grid-cols-2 md:grid-cols-5 gap-4">
                                            @if($ranking->academic_reputation)
                                            <div class="text-center p-3 bg-gray-50 rounded">
                                                <div class="text-lg font-semibold text-gray-800">{{ number_format($ranking->academic_reputation, 1) }}</div>
                                                <div class="text-xs text-gray-600">Academic Reputation</div>
                                            </div>
                                            @endif

                                            @if($ranking->citations_per_faculty)
                                            <div class="text-center p-3 bg-gray-50 rounded">
                                                <div class="text-lg font-semibold text-gray-800">{{ number_format($ranking->citations_per_faculty, 1) }}</div>
                                                <div class="text-xs text-gray-600">Citations per Faculty</div>
                                            </div>
                                            @endif

                                            @if($ranking->employability)
                                            <div class="text-center p-3 bg-gray-50 rounded">
                                                <div class="text-lg font-semibold text-gray-800">{{ number_format($ranking->employability, 1) }}</div>
                                                <div class="text-xs text-gray-600">Employability</div>
                                            </div>
                                            @endif

                                            @if($ranking->international_students)
                                            <div class="text-center p-3 bg-gray-50 rounded">
                                                <div class="text-lg font-semibold text-gray-800">{{ number_format($ranking->international_students, 1) }}</div>
                                                <div class="text-xs text-gray-600">Int'l Students</div>
                                            </div>
                                            @endif

                                            @if($ranking->sustainability)
                                            <div class="text-center p-3 bg-gray-50 rounded">
                                                <div class="text-lg font-semibold text-gray-800">{{ number_format($ranking->sustainability, 1) }}</div>
                                                <div class="text-xs text-gray-600">Sustainability</div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <i class="fas fa-search text-gray-300 text-6xl mb-4"></i>
                                <p class="text-gray-600">No universities found matching your criteria.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $rankings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // University Search with AJAX
        const searchInput = document.getElementById('universitySearch');
        const searchResults = document.getElementById('searchResults');
        let searchTimeout;
        
        searchInput.addEventListener('input', function(e) {
            const query = e.target.value.trim();
            
            clearTimeout(searchTimeout);
            
            if (query.length < 2) {
                searchResults.classList.add('hidden');
                return;
            }
            
            searchTimeout = setTimeout(() => {
                fetch(`/api/search?query=${encodeURIComponent(query)}&year={{ $year }}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.universities.length === 0) {
                            searchResults.innerHTML = '<div class="p-4 text-gray-500 text-center">No universities found</div>';
                            searchResults.classList.remove('hidden');
                            return;
                        }
                        
                        let html = '<div class="divide-y">';
                        data.universities.forEach(uni => {
                            const ranking = uni.rankings && uni.rankings.length > 0 ? uni.rankings[0] : null;
                            const rankBadge = ranking ? `
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                    #${ranking.rank}
                                </span>
                            ` : '';
                            
                            html += `
                                <a href="/rankings/university/${uni.slug}" class="block p-4 hover:bg-gray-50 transition">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <div class="font-semibold text-gray-800 mb-1">${uni.name}</div>
                                            <div class="text-sm text-gray-600">
                                                <i class="fas fa-map-marker-alt mr-1"></i>
                                                ${uni.city}, ${uni.country}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            ${rankBadge}
                                        </div>
                                    </div>
                                </a>
                            `;
                        });
                        html += '</div>';
                        
                        searchResults.innerHTML = html;
                        searchResults.classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                        searchResults.innerHTML = '<div class="p-4 text-red-500 text-center">Search error occurred</div>';
                        searchResults.classList.remove('hidden');
                    });
            }, 300);
        });
        
        // Click outside to close search results
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.classList.add('hidden');
            }
        });

        // Auto-submit filter form on change
        document.querySelectorAll('#filterForm select').forEach(select => {
            select.addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });
        });
    </script>
@endsection
