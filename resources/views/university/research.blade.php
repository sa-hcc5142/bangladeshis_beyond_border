@extends('layouts.main')

@section('title', $university->name . ' - Research Opportunities')

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
            <span>Research Opportunities</span>
        </nav>

        <!-- Header -->
        <div class="relative overflow-hidden rounded-2xl mb-8">
            <div class="absolute inset-0" style="background: linear-gradient(135deg, #127083 0%, #38bdf8 100%);"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-400/30 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-cyan-400/30 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 p-8">
                <h1 class="text-3xl md:text-4xl font-bold mb-4 text-white drop-shadow-lg">
                    {{ $university->name }} — Research Opportunities
                </h1>
                <p class="text-white text-lg">
                    Explore cutting-edge research centers, funded projects, and collaboration opportunities. From undergraduate research assistantships to doctoral programs, find your place in advancing human knowledge.
                </p>
            </div>
        </div>

        <!-- Research Centers Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Research Card 1 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1485827404703-89b55fcc595e?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="AI Research Lab">
                <div class="p-6">
                    <div class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold mb-3">
                        AI & Machine Learning
                    </div>
                    <h3 class="text-xl font-bold mb-2">Institute for Artificial Intelligence</h3>
                    <p class="text-gray-600 mb-4">
                        $100M+ in annual funding. Focus areas: computer vision, natural language processing, robotics. 200+ PhD students and postdocs. Industry partnerships with Google, Microsoft, Amazon.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Visit Lab Website <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Research Card 2 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1578496479531-32e296d5c6e1?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Biomedical Research">
                <div class="p-6">
                    <div class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold mb-3">
                        Biomedical Sciences
                    </div>
                    <h3 class="text-xl font-bold mb-2">Center for Cancer Research</h3>
                    <p class="text-gray-600 mb-4">
                        World-leading cancer research with 15 active clinical trials. NIH-funded R01 grants exceeding $75M. Breakthrough therapies in immunotherapy and precision medicine.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Explore Research <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Research Card 3 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Climate Science">
                <div class="p-6">
                    <div class="inline-block px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-sm font-semibold mb-3">
                        Climate & Environment
                    </div>
                    <h3 class="text-xl font-bold mb-2">Climate Solutions Lab</h3>
                    <p class="text-gray-600 mb-4">
                        Leading research in renewable energy, carbon capture, and climate modeling. Partnerships with UN Climate Council. Field stations on 4 continents. $60M DOE funding.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Learn More <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Opportunity Card 1 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Undergraduate Research">
                <div class="p-6">
                    <div class="inline-block px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-semibold mb-3">
                        Undergraduate
                    </div>
                    <h3 class="text-xl font-bold mb-2">Summer Research Program</h3>
                    <p class="text-gray-600 mb-4">
                        10-week paid program ($6,000 stipend) for undergraduates. Work with faculty on cutting-edge projects. Housing provided. Past participants published in top journals.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Application Info <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Opportunity Card 2 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="PhD Program">
                <div class="p-6">
                    <div class="inline-block px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm font-semibold mb-3">
                        Graduate
                    </div>
                    <h3 class="text-xl font-bold mb-2">Fully-Funded PhD Positions</h3>
                    <p class="text-gray-600 mb-4">
                        5-year PhD programs with full tuition waiver + $40K/year stipend. Health insurance included. Access to state-of-the-art facilities. Average time to degree: 5.2 years.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        PhD Programs <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Opportunity Card 3 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Postdoc Program">
                <div class="p-6">
                    <div class="inline-block px-3 py-1 bg-pink-100 text-pink-800 rounded-full text-sm font-semibold mb-3">
                        Postdoctoral
                    </div>
                    <h3 class="text-xl font-bold mb-2">Presidential Postdoctoral Fellowships</h3>
                    <p class="text-gray-600 mb-4">
                        Prestigious 3-year fellowships for recent PhDs. $75K salary + $10K research funds. Mentorship from top faculty. Path to faculty positions. Application deadline: December 1st.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Apply Now <i class="fas fa-external-link-alt ml-2 text-sm"></i>
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
