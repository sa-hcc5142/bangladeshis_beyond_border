@extends('layouts.main')

@section('title', $university->name . ' - Profile & Rankings')

@section('content')
<div class="bg-gray-50 py-8">
    <!-- Header -->
    <div class="relative overflow-hidden mb-8 rounded-2xl">
        <div class="absolute inset-0" style="background: linear-gradient(135deg, #127083 0%, #38bdf8 100%);"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-400/30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-cyan-400/30 rounded-full blur-3xl"></div>
        
        <div class="container mx-auto px-4 py-8 relative z-10">
            <a href="{{ route('rankings.index') }}" class="inline-block mb-4 text-white hover:text-blue-100 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Rankings
            </a>
            <h1 class="text-4xl font-bold text-white drop-shadow-lg">{{ $university->name }}</h1>
            <div class="flex items-center mt-2 text-white">
                <i class="fas fa-map-marker-alt mr-2"></i>
                <span>{{ $university->city }}, {{ $university->country }}</span>
                @if($university->website)
                    <a href="{{ $university->website }}" target="_blank" class="ml-4 hover:text-blue-100 transition">
                        <i class="fas fa-external-link-alt mr-1"></i>
                        Official Website
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4">
        <!-- Overall Ranking Card -->
        @if($latestRanking)
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <div class="grid md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="text-6xl font-bold text-blue-600">{{ $latestRanking->rank }}</div>
                    <div class="text-gray-600 mt-2">World Rank {{ $latestRanking->year }}</div>
                </div>
                <div class="text-center">
                    <div class="text-6xl font-bold text-green-600">{{ number_format($latestRanking->overall_score, 1) }}</div>
                    <div class="text-gray-600 mt-2">Overall Score</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-700">{{ $university->region }}</div>
                    <div class="text-gray-600 mt-2">Region</div>
                </div>
            </div>
        </div>

        <!-- Performance Metrics -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Performance Metrics {{ $latestRanking->year }}</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @if($latestRanking->academic_reputation)
                <div class="text-center p-5 bg-gray-800/50 backdrop-blur-sm rounded-lg border-l-4 border-blue-500 shadow-lg hover:bg-gray-800/70 transition-all">
                    <div class="text-4xl font-bold text-blue-400 mb-2">{{ number_format($latestRanking->academic_reputation, 1) }}</div>
                    <div class="text-sm text-gray-300 font-medium">Academic Reputation</div>
                </div>
                @endif

                @if($latestRanking->employer_reputation)
                <div class="text-center p-5 bg-gray-800/50 backdrop-blur-sm rounded-lg border-l-4 border-green-500 shadow-lg hover:bg-gray-800/70 transition-all">
                    <div class="text-4xl font-bold text-green-400 mb-2">{{ number_format($latestRanking->employer_reputation, 1) }}</div>
                    <div class="text-sm text-gray-300 font-medium">Employer Reputation</div>
                </div>
                @endif

                @if($latestRanking->citations_per_faculty)
                <div class="text-center p-5 bg-gray-800/50 backdrop-blur-sm rounded-lg border-l-4 border-purple-500 shadow-lg hover:bg-gray-800/70 transition-all">
                    <div class="text-4xl font-bold text-purple-400 mb-2">{{ number_format($latestRanking->citations_per_faculty, 1) }}</div>
                    <div class="text-sm text-gray-300 font-medium">Citations per Faculty</div>
                </div>
                @endif

                @if($latestRanking->faculty_student_ratio)
                <div class="text-center p-5 bg-gray-800/50 backdrop-blur-sm rounded-lg border-l-4 border-yellow-500 shadow-lg hover:bg-gray-800/70 transition-all">
                    <div class="text-4xl font-bold text-yellow-400 mb-2">{{ number_format($latestRanking->faculty_student_ratio, 1) }}</div>
                    <div class="text-sm text-gray-300 font-medium">Faculty/Student Ratio</div>
                </div>
                @endif

                @if($latestRanking->international_students)
                <div class="text-center p-5 bg-gray-800/50 backdrop-blur-sm rounded-lg border-l-4 border-pink-500 shadow-lg hover:bg-gray-800/70 transition-all">
                    <div class="text-4xl font-bold text-pink-400 mb-2">{{ number_format($latestRanking->international_students, 1) }}</div>
                    <div class="text-sm text-gray-300 font-medium">International Students</div>
                </div>
                @endif

                @if($latestRanking->research_discovery)
                <div class="text-center p-5 bg-gray-800/50 backdrop-blur-sm rounded-lg border-l-4 border-indigo-500 shadow-lg hover:bg-gray-800/70 transition-all">
                    <div class="text-4xl font-bold text-indigo-400 mb-2">{{ number_format($latestRanking->research_discovery, 1) }}</div>
                    <div class="text-sm text-gray-300 font-medium">Research & Discovery</div>
                </div>
                @endif

                @if($latestRanking->learning_experience)
                <div class="text-center p-5 bg-gray-800/50 backdrop-blur-sm rounded-lg border-l-4 border-teal-500 shadow-lg hover:bg-gray-800/70 transition-all">
                    <div class="text-4xl font-bold text-teal-400 mb-2">{{ number_format($latestRanking->learning_experience, 1) }}</div>
                    <div class="text-sm text-gray-300 font-medium">Learning Experience</div>
                </div>
                @endif

                @if($latestRanking->employability)
                <div class="text-center p-5 bg-gray-800/50 backdrop-blur-sm rounded-lg border-l-4 border-orange-500 shadow-lg hover:bg-gray-800/70 transition-all">
                    <div class="text-4xl font-bold text-orange-400 mb-2">{{ number_format($latestRanking->employability, 1) }}</div>
                    <div class="text-sm text-gray-300 font-medium">Employability</div>
                </div>
                @endif

                @if($latestRanking->global_engagement)
                <div class="text-center p-5 bg-gray-800/50 backdrop-blur-sm rounded-lg border-l-4 border-red-500 shadow-lg hover:bg-gray-800/70 transition-all">
                    <div class="text-4xl font-bold text-red-400 mb-2">{{ number_format($latestRanking->global_engagement, 1) }}</div>
                    <div class="text-sm text-gray-300 font-medium">Global Engagement</div>
                </div>
                @endif

                @if($latestRanking->sustainability)
                <div class="text-center p-5 bg-gray-800/50 backdrop-blur-sm rounded-lg border-l-4 border-emerald-500 shadow-lg hover:bg-gray-800/70 transition-all">
                    <div class="text-4xl font-bold text-emerald-400 mb-2">{{ number_format($latestRanking->sustainability, 1) }}</div>
                    <div class="text-sm text-gray-300 font-medium">Sustainability</div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Quick Actions Section -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="{{ $university->quickLinks?->undergraduate_admission_url ?? $university->website }}" target="_blank" rel="noopener noreferrer" class="block p-6 bg-gray-800/50 backdrop-blur-sm rounded-lg hover:shadow-xl hover:bg-gray-800/70 card-hover border border-gray-700 hover:border-blue-500 shadow-lg transition-all">
                    <i class="fas fa-user-graduate text-4xl text-blue-400 mb-3"></i>
                    <h3 class="font-bold text-lg mb-2 text-white">Admission Undergraduate</h3>
                    <p class="text-gray-400 text-sm">Requirements, deadlines, application process</p>
                </a>
                <a href="{{ $university->quickLinks?->postgraduate_admission_url ?? $university->website }}" target="_blank" rel="noopener noreferrer" class="block p-6 bg-gray-800/50 backdrop-blur-sm rounded-lg hover:shadow-xl hover:bg-gray-800/70 card-hover border border-gray-700 hover:border-purple-500 shadow-lg transition-all">
                    <i class="fas fa-graduation-cap text-4xl text-purple-400 mb-3"></i>
                    <h3 class="font-bold text-lg mb-2 text-white">Admission Postgraduate</h3>
                    <p class="text-gray-400 text-sm">Master's & PhD programs, funding options</p>
                </a>
                <a href="{{ $university->quickLinks?->academic_timeline_url ?? $university->website }}" target="_blank" rel="noopener noreferrer" class="block p-6 bg-gray-800/50 backdrop-blur-sm rounded-lg hover:shadow-xl hover:bg-gray-800/70 card-hover border border-gray-700 hover:border-green-500 shadow-lg transition-all">
                    <i class="fas fa-calendar-alt text-4xl text-green-400 mb-3"></i>
                    <h3 class="font-bold text-lg mb-2 text-white">Academic Timeline</h3>
                    <p class="text-gray-400 text-sm">Important dates, semesters, breaks</p>
                </a>
                <a href="{{ $university->quickLinks?->fullride_scholarship_url ?? $university->website }}" target="_blank" rel="noopener noreferrer" class="block p-6 bg-gray-800/50 backdrop-blur-sm rounded-lg hover:shadow-xl hover:bg-gray-800/70 card-hover border border-gray-700 hover:border-yellow-500 shadow-lg transition-all">
                    <i class="fas fa-trophy text-4xl text-yellow-400 mb-3"></i>
                    <h3 class="font-bold text-lg mb-2 text-white">Full Scholarships</h3>
                    <p class="text-gray-400 text-sm">100% tuition waiver, need-based opportunities</p>
                </a>
                <a href="{{ $university->quickLinks?->partial_scholarship_url ?? $university->website }}" target="_blank" rel="noopener noreferrer" class="block p-6 bg-gray-800/50 backdrop-blur-sm rounded-lg hover:shadow-xl hover:bg-gray-800/70 card-hover border border-gray-700 hover:border-pink-500 shadow-lg transition-all">
                    <i class="fas fa-hand-holding-usd text-4xl text-pink-400 mb-3"></i>
                    <h3 class="font-bold text-lg mb-2 text-white">Partial Scholarships</h3>
                    <p class="text-gray-400 text-sm">Financial aid, grants, cost assistance</p>
                </a>
                <a href="{{ $university->quickLinks?->more_info_url ?? $university->website }}" target="_blank" rel="noopener noreferrer" class="block p-6 bg-gray-800/50 backdrop-blur-sm rounded-lg hover:shadow-xl hover:bg-gray-800/70 card-hover border border-gray-700 hover:border-indigo-500 shadow-lg transition-all">
                    <i class="fas fa-info-circle text-4xl text-indigo-400 mb-3"></i>
                    <h3 class="font-bold text-lg mb-2 text-white">More Information</h3>
                    <p class="text-gray-400 text-sm">FAQs, virtual tours, contact admissions</p>
                </a>
            </div>
        </div>

        <!-- Deep-Dive Sections -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Explore {{ $university->name }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('university.alumni', $university->slug) }}" class="block p-6 bg-gray-800/50 backdrop-blur-sm rounded-lg hover:shadow-xl hover:bg-gray-800/70 card-hover border border-gray-700 hover:border-blue-500 shadow-lg transition-all">
                    <div class="flex items-start">
                        <i class="fas fa-users text-5xl text-blue-400 mr-4"></i>
                        <div>
                            <h3 class="font-bold text-xl mb-2 text-white">Notable Alumni & Faculty</h3>
                            <p class="text-gray-400 mb-3 text-sm">Discover distinguished graduates and professors who shaped their fields.</p>
                            <span class="text-blue-400 font-semibold inline-flex items-center hover:text-blue-300 transition-colors">
                                View Profiles <i class="fas fa-arrow-right ml-2"></i>
                            </span>
                        </div>
                    </div>
                </a>

                <a href="{{ route('university.research', $university->slug) }}" class="block p-6 bg-gray-800/50 backdrop-blur-sm rounded-lg hover:shadow-xl hover:bg-gray-800/70 card-hover border border-gray-700 hover:border-green-500 shadow-lg transition-all">
                    <div class="flex items-start">
                        <i class="fas fa-flask text-5xl text-green-400 mr-4"></i>
                        <div>
                            <h3 class="font-bold text-xl mb-2 text-white">Research Opportunities</h3>
                            <p class="text-gray-400 mb-3 text-sm">Explore world-class research centers and undergraduate programs.</p>
                            <span class="text-green-400 font-semibold inline-flex items-center hover:text-green-300 transition-colors">
                                Explore Research <i class="fas fa-arrow-right ml-2"></i>
                            </span>
                        </div>
                    </div>
                </a>

                <a href="{{ route('university.residential', $university->slug) }}" class="block p-6 bg-gray-800/50 backdrop-blur-sm rounded-lg hover:shadow-xl hover:bg-gray-800/70 card-hover border border-gray-700 hover:border-purple-500 shadow-lg transition-all">
                    <div class="flex items-start">
                        <i class="fas fa-home text-5xl text-purple-400 mr-4"></i>
                        <div>
                            <h3 class="font-bold text-xl mb-2 text-white">Residential Facility & Security</h3>
                            <p class="text-gray-400 mb-3 text-sm">Safe, comfortable housing with 24/7 support and amenities.</p>
                            <span class="text-purple-400 font-semibold inline-flex items-center hover:text-purple-300 transition-colors">
                                View Housing <i class="fas fa-arrow-right ml-2"></i>
                            </span>
                        </div>
                    </div>
                </a>

                <a href="{{ route('university.jobs', $university->slug) }}" class="block p-6 bg-gray-800/50 backdrop-blur-sm rounded-lg hover:shadow-xl hover:bg-gray-800/70 card-hover border border-gray-700 hover:border-orange-500 shadow-lg transition-all">
                    <div class="flex items-start">
                        <i class="fas fa-briefcase text-5xl text-orange-400 mr-4"></i>
                        <div>
                            <h3 class="font-bold text-xl mb-2 text-white">Part-time Job Opportunities</h3>
                            <p class="text-gray-400 mb-3 text-sm">On-campus employment, internships, and work-study programs.</p>
                            <span class="text-orange-400 font-semibold inline-flex items-center hover:text-orange-300 transition-colors">
                                Find Jobs <i class="fas fa-arrow-right ml-2"></i>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Subject Rankings -->
        @if($subjectRankings->count() > 0)
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold mb-6">Rankings by Subject</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($subjectRankings as $subjectRanking)
                <a href="{{ route('rankings.by-subject', $subjectRanking->subject->slug) }}" class="block p-4 border border-gray-200 rounded-lg hover:border-purple-500 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="text-3xl mr-3">{{ $subjectRanking->subject->icon ?? '📚' }}</span>
                            <div>
                                <div class="font-semibold text-gray-800">{{ $subjectRanking->subject->name }}</div>
                                <div class="text-sm text-gray-600">Rank: #{{ $subjectRanking->rank }}</div>
                            </div>
                        </div>
                        <div class="text-2xl font-bold text-purple-600">
                            {{ number_format($subjectRanking->score, 1) }}
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
