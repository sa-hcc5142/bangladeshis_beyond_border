@extends('layouts.main')

@section('title', $university->name . ' - Notable Alumni & Faculty')

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
            <span>Notable Alumni & Faculty</span>
        </nav>

        <!-- Header -->
        <div class="relative overflow-hidden rounded-2xl mb-8">
            <div class="absolute inset-0" style="background: linear-gradient(135deg, #127083 0%, #38bdf8 100%);"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-400/30 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-cyan-400/30 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 p-8">
                <h1 class="text-3xl md:text-4xl font-bold mb-4 text-white drop-shadow-lg">
                    {{ $university->name }} — Notable Alumni & Faculty
                </h1>
                <p class="text-white text-lg">
                    Discover distinguished graduates, renowned professors, and influential figures who have shaped fields ranging from science to public service. This section highlights the impactful contributions of {{ $university->name }}'s academic community.
                </p>
            </div>
        </div>

        <!-- Alumni Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Alumni Card 1 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Alumni 1">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">Nobel Prize Winner</h3>
                    <p class="text-gray-600 mb-4">
                        Distinguished alumnus who received the Nobel Prize in Physics for groundbreaking research in quantum mechanics. Published over 200 papers and mentored countless students.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Learn More <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Alumni Card 2 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1556157382-97eda2d62296?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Alumni 2">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">Tech Pioneer</h3>
                    <p class="text-gray-600 mb-4">
                        Founded a unicorn startup that revolutionized the artificial intelligence industry. Current Forbes 30 Under 30 recipient and venture capital investor.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Learn More <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Alumni Card 3 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1577962917302-cd874c4e31d2?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Government Leader">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">Government Leader</h3>
                    <p class="text-gray-600 mb-4">
                        Served as cabinet minister and led major policy reforms in education and healthcare. Known for advocacy in sustainable development goals.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Learn More <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Faculty Card 1 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Faculty 1">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">Distinguished Professor</h3>
                    <p class="text-gray-600 mb-4">
                        Leading researcher in computational biology with H-index of 85. Published in Nature, Science, and Cell. Principal investigator on $50M NIH grant.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Faculty Profile <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Faculty Card 2 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Faculty 2">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">MacArthur Fellow</h3>
                    <p class="text-gray-600 mb-4">
                        Recipient of the "Genius Grant" for work in climate science and environmental policy. Advised multiple international organizations and governments.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Faculty Profile <i class="fas fa-external-link-alt ml-2 text-sm"></i>
                    </a>
                </div>
            </article>

            <!-- Faculty Card 3 -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Faculty 3">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">Bestselling Author</h3>
                    <p class="text-gray-600 mb-4">
                        Professor of literature and critically acclaimed novelist. Works translated into 40+ languages. Regular contributor to The New Yorker and The Atlantic.
                    </p>
                    <a href="#" target="_blank" class="text-blue-600 hover:underline inline-flex items-center">
                        Faculty Profile <i class="fas fa-external-link-alt ml-2 text-sm"></i>
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
