@extends('layouts.main')

@section('title', $university->name . ' - Part-time Job Opportunities')

@section('content')
<div class="bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Breadcrumbs -->
        <nav class="text-sm text-gray-600 mb-6">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>
            <span class="mx-2">▸</span>
            <a href="{{ route('rankings.index') }}" class="hover:text-blue-600">Rankings</a>
            <span class="mx-2">▸</span>
            <a href="{{ route('rankings.show', $university->slug) }}" class="hover:text-blue-600">{{ $university->name }}</a>
            <span class="mx-2">▸</span>
            <span>Part-time Job Opportunities</span>
        </nav>

        <!-- Header -->
        <div class="relative overflow-hidden rounded-2xl mb-8">
            <div class="absolute inset-0" style="background: linear-gradient(135deg, #127083 0%, #38bdf8 100%);"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-400/30 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-cyan-400/30 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 p-8">
                <h1 class="text-3xl md:text-4xl font-bold mb-4 text-white drop-shadow-lg">
                    {{ $university->name }} — Part-time Job Opportunities
                </h1>
                <p class="text-white text-lg">
                    Balance academics with work experience through on-campus employment, internships, and student positions. Build skills, earn income, and enhance your resume while studying.
                </p>
            </div>
        </div>

        <!-- Jobs Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Job Card 1 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1581092160562-40aa08e78837?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Research Assistant">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <div class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                            Academic
                        </div>
                        <div class="text-green-600 font-bold">$15-18/hr</div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Undergraduate Research Assistant</h3>
                    <p class="text-gray-600 mb-4">
                        Work directly with faculty on cutting-edge research projects. Flexible hours (10-15 hrs/week). Gain hands-on lab experience. Potential for publication authorship. Great for grad school applications.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        View Positions <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Job Card 2 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Teaching Assistant">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <div class="inline-block px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-semibold">
                            Teaching
                        </div>
                        <div class="text-green-600 font-bold">$16-20/hr</div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Course Teaching Assistant</h3>
                    <p class="text-gray-600 mb-4">
                        Lead discussion sections, grade assignments, hold office hours. Strengthen understanding of subject matter. Develop leadership and communication skills. Priority for students with 3.5+ GPA.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Apply Online <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Job Card 3 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Library Assistant">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <div class="inline-block px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-sm font-semibold">
                            Library
                        </div>
                        <div class="text-green-600 font-bold">$14-16/hr</div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Library Student Worker</h3>
                    <p class="text-gray-600 mb-4">
                        Assist patrons with research, shelve books, manage circulation desk. Quiet work environment ideal for studying during downtime. Evening and weekend shifts available. 10-20 hours per week.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Job Details <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Job Card 4 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="IT Support">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <div class="inline-block px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm font-semibold">
                            Technology
                        </div>
                        <div class="text-green-600 font-bold">$17-22/hr</div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">IT Help Desk Technician</h3>
                    <p class="text-gray-600 mb-4">
                        Provide technical support to students and faculty. Troubleshoot hardware/software issues. Gain IT certifications. Build customer service skills. Training provided. Flexible scheduling around classes.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Apply Now <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Job Card 5 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Campus Tour Guide">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <div class="inline-block px-3 py-1 bg-pink-100 text-pink-800 rounded-full text-sm font-semibold">
                            Admissions
                        </div>
                        <div class="text-green-600 font-bold">$15-17/hr</div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Campus Tour Guide</h3>
                    <p class="text-gray-600 mb-4">
                        Lead prospective students and families on campus tours. Share your university experience. Develop public speaking skills. Represent the university at admissions events. Weekend availability preferred.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Learn More <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Job Card 6 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Dining Services">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <div class="inline-block px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-sm font-semibold">
                            Dining
                        </div>
                        <div class="text-green-600 font-bold">$14-16/hr</div>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Dining Hall Student Worker</h3>
                    <p class="text-gray-600 mb-4">
                        Various positions: cashier, food service, dishwasher. Meal benefits included. Immediate hiring. Variety of shift times. Team environment. No experience required. On-the-job training provided.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        See Openings <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>
        </div>

        <!-- Federal Work-Study Info -->
        <div class="bg-gray-800/50 backdrop-blur-sm border-2 border-blue-500 rounded-xl p-6 mb-8">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-3xl text-blue-400"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-2 text-white">Federal Work-Study Program</h3>
                    <p class="text-gray-300 mb-3 font-medium">
                        Part of your financial aid package. Earn up to $3,500/semester through on-campus employment. Positions reserved for eligible students. Flexible hours designed to accommodate class schedules.
                    </p>
                    <a href="#" target="_blank" class="text-blue-400 hover:text-blue-300 hover:underline font-bold inline-flex items-center transition-colors">
                        Check Eligibility <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="flex justify-center">
            <a href="{{ route('rankings.show', $university->slug) }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg smooth-transition inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to {{ $university->name }}
            </a>
        </div>
    </div>
</div>
@endsection
