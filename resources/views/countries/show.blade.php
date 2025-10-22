@extends('layouts.main')

@section('title', $country['name'] . ' - Country Guide')

@section('content')
<div class="bg-gray-50 py-8">
    <!-- Hero Header -->
    <div class="relative h-64 mb-8 overflow-hidden">
        <img src="{{ $country['hero_image'] }}" 
             class="w-full h-full object-cover" alt="{{ $country['name'] }}">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-indigo-900/60"></div>
        <div class="absolute inset-0 flex items-center">
            <div class="container mx-auto px-4">
                <nav class="text-sm text-white mb-4">
                    <a href="{{ route('home') }}" class="hover:underline">Home</a>
                    <span class="mx-2">▸</span>
                    <a href="{{ route('countries.index') }}" class="hover:underline">Countries</a>
                    <span class="mx-2">▸</span>
                    <span>{{ $country['name'] }}</span>
                </nav>
                <h1 class="text-5xl font-bold text-white mb-2">{{ $country['name'] }}</h1>
                <p class="text-xl text-blue-100">{{ $country['tagline'] }}</p>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4">
        <!-- Quick Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                <div class="text-3xl font-bold text-blue-600">{{ $country['stats']['universities'] }}</div>
                <div class="text-gray-600 mt-1">Top Universities</div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                <div class="text-3xl font-bold text-green-600">{{ $country['stats']['monthly_cost'] }}</div>
                <div class="text-gray-600 mt-1">Avg. Monthly Cost</div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                <div class="text-3xl font-bold text-purple-600">{{ $country['stats']['students'] }}</div>
                <div class="text-gray-600 mt-1">International Students</div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                <div class="text-3xl font-bold text-orange-600">{{ $country['stats']['work_hours'] }}</div>
                <div class="text-gray-600 mt-1">Work per Week</div>
            </div>
        </div>

        <!-- Feature Blocks Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Living Cost -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-300">
                <img src="{{ $country['sections']['living_cost']['image'] }}" 
                     class="w-full h-48 object-cover" alt="Living Cost">
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-dollar-sign text-3xl text-green-600 mr-3"></i>
                        <h2 class="text-2xl font-bold">Living Cost</h2>
                    </div>
                    <div class="text-gray-700 space-y-2">
                        <p><strong>Tuition:</strong> {{ $country['sections']['living_cost']['tuition'] }}</p>
                        <p><strong>Housing:</strong> {{ $country['sections']['living_cost']['housing'] }}</p>
                        <p><strong>Food:</strong> {{ $country['sections']['living_cost']['food'] }}</p>
                        <p><strong>Transportation:</strong> {{ $country['sections']['living_cost']['transport'] }}</p>
                        <p><strong>Health Insurance:</strong> {{ $country['sections']['living_cost']['insurance'] }}</p>
                        <p class="text-sm text-gray-500 mt-3">
                            <span class="see-more-text line-clamp-3">
                                {{ $country['sections']['living_cost']['tip'] }}
                            </span>
                            <button class="see-more-btn text-blue-600 hover:underline ml-1">See more</button>
                        </p>
                    </div>
                </div>
            </article>

            <!-- Language -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-300">
                <img src="{{ $country['sections']['language']['image'] }}" 
                     class="w-full h-48 object-cover" alt="Language">
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-language text-3xl text-blue-600 mr-3"></i>
                        <h2 class="text-2xl font-bold">Language & ESL</h2>
                    </div>
                    <div class="text-gray-700 space-y-2">
                        <p><strong>Primary Language:</strong> {{ $country['sections']['language']['primary'] }}</p>
                        <p><strong>Required Tests:</strong> {{ $country['sections']['language']['tests'] }}</p>
                        <p><strong>ESL Programs:</strong> {{ $country['sections']['language']['esl'] }}</p>
                        <p><strong>Conditional Admission:</strong> {{ $country['sections']['language']['admission'] }}</p>
                        <p><strong>Academic Support:</strong> {{ $country['sections']['language']['support'] }}</p>
                        <p class="text-sm text-gray-500 mt-3">
                            <span class="see-more-text line-clamp-3">
                                {{ $country['sections']['language']['tip'] }}
                            </span>
                            <button class="see-more-btn text-blue-600 hover:underline ml-1">See more</button>
                        </p>
                    </div>
                </div>
            </article>

            <!-- Culture -->
                        <!-- Culture -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-300">
                <img src="{{ $country['sections']['culture']['image'] }}" 
                     class="w-full h-48 object-cover" alt="Culture">
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-users text-3xl text-purple-600 mr-3"></i>
                        <h2 class="text-2xl font-bold">Culture & Academic Life</h2>
                    </div>
                    <div class="text-gray-700 space-y-2">
                        <p><strong>Academic Style:</strong> {{ $country['sections']['culture']['style'] }}</p>
                        <p><strong>Participation:</strong> {{ $country['sections']['culture']['participation'] }}</p>
                        <p><strong>Diversity:</strong> {{ $country['sections']['culture']['diversity'] }}</p>
                        <p><strong>Student Organizations:</strong> {{ $country['sections']['culture']['organizations'] }}</p>
                        <p><strong>Campus Life:</strong> {{ $country['sections']['culture']['campus_life'] }}</p>
                        <p class="text-sm text-gray-500 mt-3">
                            <span class="see-more-text line-clamp-3">
                                {{ $country['sections']['culture']['tip'] }}
                            </span>
                            <button class="see-more-btn text-blue-600 hover:underline ml-1">See more</button>
                        </p>
                    </div>
                </div>
            </article>

            <!-- Food -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-300">
                <img src="{{ $country['sections']['food']['image'] }}" 
                     class="w-full h-48 object-cover" alt="Food">
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-utensils text-3xl text-orange-600 mr-3"></i>
                        <h2 class="text-2xl font-bold">Food & Dining</h2>
                    </div>
                    <div class="text-gray-700 space-y-2">
                        <p><strong>Campus Dining:</strong> {{ $country['sections']['food']['campus'] }}</p>
                        <p><strong>Halal Options:</strong> {{ $country['sections']['food']['halal'] }}</p>
                        <p><strong>International Grocery:</strong> {{ $country['sections']['food']['grocery'] }}</p>
                        <p><strong>Eating Out:</strong> {{ $country['sections']['food']['eating_out'] }}</p>
                        <p><strong>Cooking:</strong> {{ $country['sections']['food']['cooking'] }}</p>
                        <p class="text-sm text-gray-500 mt-3">
                            <span class="see-more-text line-clamp-3">
                                {{ $country['sections']['food']['tip'] }}
                            </span>
                            <button class="see-more-btn text-blue-600 hover:underline ml-1">See more</button>
                        </p>
                    </div>
                </div>
            </article>

            <!-- Community -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-300">
                <img src="{{ $country['sections']['community']['image'] }}" 
                     class="w-full h-48 object-cover" alt="Community">
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-heart text-3xl text-pink-600 mr-3"></i>
                        <h2 class="text-2xl font-bold">Community & Support</h2>
                    </div>
                    <div class="text-gray-700 space-y-2">
                        <p><strong>Muslim Student Associations:</strong> {{ $country['sections']['community']['msa'] }}</p>
                        <p><strong>Prayer Spaces:</strong> {{ $country['sections']['community']['prayer'] }}</p>
                        <p><strong>Cultural Centers:</strong> {{ $country['sections']['community']['centers'] }}</p>
                        <p><strong>Mentorship Programs:</strong> {{ $country['sections']['community']['mentorship'] }}</p>
                        <p><strong>International Student Office:</strong> {{ $country['sections']['community']['iso'] }}</p>
                        <p class="text-sm text-gray-500 mt-3">
                            <span class="see-more-text line-clamp-3">
                                {{ $country['sections']['community']['tip'] }}
                            </span>
                            <button class="see-more-btn text-blue-600 hover:underline ml-1">See more</button>
                        </p>
                    </div>
                </div>
            </article>

            <!-- Visa Help -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-300">
                <img src="{{ $country['sections']['visa']['image'] }}" 
                     class="w-full h-48 object-cover" alt="Visa">
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-passport text-3xl text-indigo-600 mr-3"></i>
                        <h2 class="text-2xl font-bold">Visa & Immigration</h2>
                    </div>
                    <div class="text-gray-700 space-y-2">
                        <p><strong>Visa Type:</strong> {{ $country['sections']['visa']['type'] }}</p>
                        <p><strong>Processing Time:</strong> {{ $country['sections']['visa']['processing'] }}</p>
                        <p><strong>Required Documents:</strong> {{ $country['sections']['visa']['documents'] }}</p>
                        <p><strong>Interview:</strong> {{ $country['sections']['visa']['interview'] }}</p>
                        <p><strong>Work Authorization:</strong> {{ $country['sections']['visa']['work'] }}</p>
                        <p class="text-sm text-gray-500 mt-3">
                            <span class="see-more-text line-clamp-3">
                                {{ $country['sections']['visa']['tip'] }}
                            </span>
                            <button class="see-more-btn text-blue-600 hover:underline ml-1">See more</button>
                        </p>
                    </div>
                </div>
            </article>

            <!-- Standardized Tests -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-300">
                <img src="{{ $country['sections']['tests']['image'] }}" 
                     class="w-full h-48 object-cover" alt="Tests">
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-pencil-alt text-3xl text-teal-600 mr-3"></i>
                        <h2 class="text-2xl font-bold">Standardized Tests</h2>
                    </div>
                    <div class="text-gray-700 space-y-2">
                        <p><strong>Undergraduate:</strong> {{ $country['sections']['tests']['undergrad'] }}</p>
                        <p><strong>Graduate:</strong> {{ $country['sections']['tests']['grad'] }}</p>
                        <p><strong>English:</strong> {{ $country['sections']['tests']['english'] }}</p>
                        <p><strong>Test Optional:</strong> {{ $country['sections']['tests']['optional'] }}</p>
                        <p><strong>Preparation:</strong> {{ $country['sections']['tests']['prep'] }}</p>
                        <p class="text-sm text-gray-500 mt-3">
                            <span class="see-more-text line-clamp-3">
                                {{ $country['sections']['tests']['tip'] }}
                            </span>
                            <button class="see-more-btn text-blue-600 hover:underline ml-1">See more</button>
                        </p>
                    </div>
                </div>
            </article>

            <!-- Weather -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 hover:shadow-2xl transition-all duration-300">
                <img src="{{ $country['sections']['weather']['image'] }}" 
                     class="w-full h-48 object-cover" alt="Weather">
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-cloud-sun text-3xl text-yellow-600 mr-3"></i>
                        <h2 class="text-2xl font-bold">Climate & Weather</h2>
                    </div>
                    <div class="text-gray-700 space-y-2">
                        @foreach($country['sections']['weather'] as $key => $value)
                            @if($key !== 'image' && $key !== 'tip')
                                <p><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</p>
                            @endif
                        @endforeach
                        <p class="text-sm text-gray-500 mt-3">
                            <span class="see-more-text line-clamp-3">
                                {{ $country['sections']['weather']['tip'] }}
                            </span>
                            <button class="see-more-btn text-blue-600 hover:underline ml-1">See more</button>
                        </p>
                    </div>
                </div>
            </article>
        </div>

        <!-- Back Button -->
        <div class="flex justify-center mb-8">
            <a href="{{ route('countries.index') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg smooth-transition inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Countries
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // See more functionality
    document.querySelectorAll('.see-more-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const text = this.previousElementSibling;
            if (text.classList.contains('line-clamp-3')) {
                text.classList.remove('line-clamp-3');
                this.textContent = 'See less';
            } else {
                text.classList.add('line-clamp-3');
                this.textContent = 'See more';
            }
        });
    });
</script>
@endpush
@endsection
