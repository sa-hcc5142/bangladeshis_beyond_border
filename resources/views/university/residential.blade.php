@extends('layouts.main')

@section('title', $university->name . ' - Residential Facility & Security')

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
            <span>Residential Facility & Security</span>
        </nav>

        <!-- Header -->
        <div class="relative overflow-hidden rounded-2xl mb-8">
            <div class="absolute inset-0" style="background: linear-gradient(135deg, #127083 0%, #38bdf8 100%);"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-400/30 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-cyan-400/30 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 p-8">
                <h1 class="text-3xl md:text-4xl font-bold mb-4 text-white drop-shadow-lg">
                    {{ $university->name }} — Residential Facility & Security
                </h1>
                <p class="text-white text-lg">
                    Safe, comfortable, and community-oriented living spaces designed to enhance your academic experience. Learn about housing options, campus security measures, and student support services.
                </p>
            </div>
        </div>

        <!-- Housing Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Housing Card 1 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1555854877-bab0e564b8d5?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="First-Year Housing">
                <div class="p-6">
                    <div class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold mb-3">
                        First-Year Students
                    </div>
                    <h3 class="text-xl font-bold mb-2">Freshman Residential Colleges</h3>
                    <p class="text-gray-600 mb-4">
                        Guaranteed housing for all first-years. Double rooms with shared bathrooms. Live-in faculty members and resident advisors. Dining halls with meal plans. Community building activities and study lounges.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Housing Application <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Housing Card 2 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Suite-Style Apartments">
                <div class="p-6">
                    <div class="inline-block px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-semibold mb-3">
                        Upperclass Students
                    </div>
                    <h3 class="text-xl font-bold mb-2">Suite-Style & Apartments</h3>
                    <p class="text-gray-600 mb-4">
                        Single and double rooms in suite arrangements. Full kitchens available. 24/7 security. Laundry facilities on every floor. Bike storage and parking permits. On-campus shuttle service.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Explore Options <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Housing Card 3 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Graduate Housing">
                <div class="p-6">
                    <div class="inline-block px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-sm font-semibold mb-3">
                        Graduate Students
                    </div>
                    <h3 class="text-xl font-bold mb-2">Graduate & Family Housing</h3>
                    <p class="text-gray-600 mb-4">
                        1-3 bedroom apartments for graduate students and families. Furnished and unfurnished options. Pet-friendly units available. Playground and community center. Affordable rates starting at $800/month.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        View Floor Plans <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Security Card 1 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Campus Security">
                <div class="p-6">
                    <div class="inline-block px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold mb-3">
                        Safety & Security
                    </div>
                    <h3 class="text-xl font-bold mb-2">24/7 Campus Police</h3>
                    <p class="text-gray-600 mb-4">
                        Dedicated police force with 150+ officers. Emergency call boxes every 100 feet. Blue light safety escort service. LiveSafe mobile app for real-time alerts. Annual crime statistics published online.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Safety Resources <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Support Card 1 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Health Services">
                <div class="p-6">
                    <div class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold mb-3">
                        Health & Wellness
                    </div>
                    <h3 class="text-xl font-bold mb-2">Student Health Center</h3>
                    <p class="text-gray-600 mb-4">
                        On-campus medical clinic with 20+ physicians. Mental health counseling services. 24/7 telehealth access. Pharmacy and laboratory services. Free flu shots and wellness programs. LGBTQ+ affirming care.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Make Appointment <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Amenities Card -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Recreation Center">
                <div class="p-6">
                    <div class="inline-block px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-sm font-semibold mb-3">
                        Recreation
                    </div>
                    <h3 class="text-xl font-bold mb-2">Fitness & Recreation</h3>
                    <p class="text-gray-600 mb-4">
                        State-of-the-art recreation center with gym, pool, rock climbing wall. Group fitness classes included. Intramural sports leagues. Outdoor adventure programs. Equipment rental for camping and skiing.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Facilities Tour <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>
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
