@extends('layouts.main')

@section('title', 'United States - Country Guide')

@section('content')
<div class="bg-gray-50 py-8">
    <!-- Hero Header -->
    <div class="relative h-64 mb-8 overflow-hidden">
        <img src="https://images.unsplash.com/photo-1485738422979-f5c462d49f74?q=80&w=1920&auto=format&fit=crop" 
             class="w-full h-full object-cover" alt="United States">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-indigo-900/60"></div>
        <div class="absolute inset-0 flex items-center">
            <div class="container mx-auto px-4">
                <nav class="text-sm text-white mb-4">
                    <a href="{{ route('home') }}" class="hover:underline">Home</a>
                    <span class="mx-2">▸</span>
                    <a href="{{ route('countries.index') }}" class="hover:underline">Countries</a>
                    <span class="mx-2">▸</span>
                    <span>United States</span>
                </nav>
                <h1 class="text-5xl font-bold text-white mb-2">🇺🇸 United States</h1>
                <p class="text-xl text-blue-100">Study in the Land of Opportunity</p>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4">
        <!-- Quick Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                <div class="text-3xl font-bold text-blue-600">150+</div>
                <div class="text-gray-600 mt-1">Top Universities</div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                <div class="text-3xl font-bold text-green-600">$1,500</div>
                <div class="text-gray-600 mt-1">Avg. Monthly Cost</div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                <div class="text-3xl font-bold text-purple-600">1M+</div>
                <div class="text-gray-600 mt-1">International Students</div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                <div class="text-3xl font-bold text-orange-600">20-40hrs</div>
                <div class="text-gray-600 mt-1">Work per Week</div>
            </div>
        </div>

        <!-- Feature Blocks Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Living Cost -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Living Cost">
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-dollar-sign text-3xl text-green-600 mr-3"></i>
                        <h2 class="text-2xl font-bold">Living Cost</h2>
                    </div>
                    <div class="text-gray-700 space-y-2">
                        <p><strong>Tuition:</strong> $20,000 - $60,000/year (varies by institution)</p>
                        <p><strong>Housing:</strong> $500 - $1,500/month (on/off campus)</p>
                        <p><strong>Food:</strong> $300 - $600/month</p>
                        <p><strong>Transportation:</strong> $50 - $150/month (public transit)</p>
                        <p><strong>Health Insurance:</strong> $1,500 - $2,500/year (mandatory)</p>
                        <p class="text-sm text-gray-500 mt-3">
                            <span class="see-more-text line-clamp-3">
                                Budget tip: Public universities in smaller cities offer lower tuition and living costs. Community colleges provide affordable pathway to 4-year degrees. Look for on-campus jobs (up to 20 hrs/week) and assistantships.
                            </span>
                            <button class="see-more-btn text-blue-600 hover:underline ml-1">See more</button>
                        </p>
                    </div>
                </div>
            </article>

            <!-- Language -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Language">
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-language text-3xl text-blue-600 mr-3"></i>
                        <h2 class="text-2xl font-bold">Language & ESL</h2>
                    </div>
                    <div class="text-gray-700 space-y-2">
                        <p><strong>Primary Language:</strong> English</p>
                        <p><strong>Required Tests:</strong> TOEFL (80+), IELTS (6.5+), Duolingo (105+)</p>
                        <p><strong>ESL Programs:</strong> Available at most universities</p>
                        <p><strong>Conditional Admission:</strong> Yes, many institutions offer</p>
                        <p><strong>Academic English:</strong> Writing centers and tutoring free</p>
                        <p class="text-sm text-gray-500 mt-3">
                            <span class="see-more-text line-clamp-3">
                                Most universities have International Student Support offices offering free conversation partners, writing workshops, and cultural orientation programs. Many cities have ESL community centers for additional practice.
                            </span>
                            <button class="see-more-btn text-blue-600 hover:underline ml-1">See more</button>
                        </p>
                    </div>
                </div>
            </article>

            <!-- Culture -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Culture">
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-users text-3xl text-purple-600 mr-3"></i>
                        <h2 class="text-2xl font-bold">Culture & Academic Life</h2>
                    </div>
                    <div class="text-gray-700 space-y-2">
                        <p><strong>Academic Style:</strong> Interactive, discussion-based, critical thinking</p>
                        <p><strong>Participation:</strong> Expected in class (counted in grade)</p>
                        <p><strong>Diversity:</strong> Very multicultural campus environments</p>
                        <p><strong>Student Organizations:</strong> 100-500+ clubs per university</p>
                        <p><strong>Campus Life:</strong> Active sports, events, Greek life</p>
                        <p class="text-sm text-gray-500 mt-3">
                            <span class="see-more-text line-clamp-3">
                                American universities emphasize speaking up in class, networking, and extracurricular involvement. Professors expect you to challenge ideas respectfully. Office hours are crucial for building relationships. Join cultural organizations to find community.
                            </span>
                            <button class="see-more-btn text-blue-600 hover:underline ml-1">See more</button>
                        </p>
                    </div>
                </div>
            </article>

            <!-- Food -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Food">
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-utensils text-3xl text-orange-600 mr-3"></i>
                        <h2 class="text-2xl font-bold">Food & Dining</h2>
                    </div>
                    <div class="text-gray-700 space-y-2">
                        <p><strong>Campus Dining:</strong> Meal plans required for freshmen</p>
                        <p><strong>Halal Options:</strong> Available in most major universities</p>
                        <p><strong>International Grocery:</strong> Easy access in cities</p>
                        <p><strong>Eating Out:</strong> $10-20 per meal average</p>
                        <p><strong>Cooking:</strong> Apartments have full kitchens</p>
                        <p class="text-sm text-gray-500 mt-3">
                            <span class="see-more-text line-clamp-3">
                                Most campus dining halls offer vegetarian and halal options. Find ethnic grocery stores for ingredients from home. Meal prep saves significant money. Many universities have halal certification for dining facilities. Student discounts available at many restaurants.
                            </span>
                            <button class="see-more-btn text-blue-600 hover:underline ml-1">See more</button>
                        </p>
                    </div>
                </div>
            </article>

            <!-- Community -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Community">
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-heart text-3xl text-pink-600 mr-3"></i>
                        <h2 class="text-2xl font-bold">Community & Support</h2>
                    </div>
                    <div class="text-gray-700 space-y-2">
                        <p><strong>Muslim Student Associations:</strong> Active at most campuses</p>
                        <p><strong>Prayer Spaces:</strong> Many universities provide</p>
                        <p><strong>Cultural Centers:</strong> Asian, African, Middle Eastern</p>
                        <p><strong>Mentorship Programs:</strong> Peer and faculty mentors</p>
                        <p><strong>International Student Office:</strong> Dedicated support staff</p>
                        <p class="text-sm text-gray-500 mt-3">
                            <span class="see-more-text line-clamp-3">
                                Connect with Bangladeshi Student Associations early. They organize cultural events, help with settling in, and provide homesickness support. Many cities have Bangladeshi communities offering home-cooked meals and cultural connection. Build diverse friendships while maintaining cultural ties.
                            </span>
                            <button class="see-more-btn text-blue-600 hover:underline ml-1">See more</button>
                        </p>
                    </div>
                </div>
            </article>

            <!-- Visa Help -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1436450412740-6b988f486c6b?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Visa">
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-passport text-3xl text-indigo-600 mr-3"></i>
                        <h2 class="text-2xl font-bold">Visa & Immigration</h2>
                    </div>
                    <div class="text-gray-700 space-y-2">
                        <p><strong>Visa Type:</strong> F-1 Student Visa</p>
                        <p><strong>Processing Time:</strong> 2-4 weeks after interview</p>
                        <p><strong>Required Documents:</strong> I-20, financial proof, passport</p>
                        <p><strong>Interview:</strong> At US Embassy in Dhaka</p>
                        <p><strong>Work Authorization:</strong> CPT, OPT (12-36 months)</p>
                        <p class="text-sm text-gray-500 mt-3">
                            <span class="see-more-text line-clamp-3">
                                Apply for visa 3 months before program start. Demonstrate strong ties to Bangladesh and clear intent to return. STEM graduates get 3-year OPT extension. H-1B visa sponsorship possible after graduation. Maintain full-time enrollment (12+ credits) to keep visa status.
                            </span>
                            <button class="see-more-btn text-blue-600 hover:underline ml-1">See more</button>
                        </p>
                    </div>
                </div>
            </article>

            <!-- Standardized Tests -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Tests">
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-pencil-alt text-3xl text-teal-600 mr-3"></i>
                        <h2 class="text-2xl font-bold">Standardized Tests</h2>
                    </div>
                    <div class="text-gray-700 space-y-2">
                        <p><strong>Undergraduate:</strong> SAT (1200+) or ACT (24+)</p>
                        <p><strong>Graduate:</strong> GRE (310+), GMAT (650+) for business</p>
                        <p><strong>English:</strong> TOEFL (80-100), IELTS (6.5-7.5)</p>
                        <p><strong>Test Optional:</strong> Some schools waive SAT/ACT</p>
                        <p><strong>Preparation:</strong> 3-6 months recommended</p>
                        <p class="text-sm text-gray-500 mt-3">
                            <span class="see-more-text line-clamp-3">
                                Khan Academy offers free SAT prep. Magoosh and Manhattan Prep are popular GRE resources. Take official practice tests to gauge progress. Many schools went test-optional post-COVID. Strong GPA and essays can offset lower test scores. Subject GRE helpful for top PhD programs.
                            </span>
                            <button class="see-more-btn text-blue-600 hover:underline ml-1">See more</button>
                        </p>
                    </div>
                </div>
            </article>

            <!-- Weather -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1534088568595-a066f410bcda?q=80&w=1200&auto=format&fit=crop" 
                     class="w-full h-48 object-cover" alt="Weather">
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-cloud-sun text-3xl text-yellow-600 mr-3"></i>
                        <h2 class="text-2xl font-bold">Climate & Weather</h2>
                    </div>
                    <div class="text-gray-700 space-y-2">
                        <p><strong>Regional Variation:</strong> Tropical to Arctic climates</p>
                        <p><strong>Northeast:</strong> Cold winters (-10°C), hot summers</p>
                        <p><strong>South:</strong> Hot, humid, mild winters</p>
                        <p><strong>West Coast:</strong> Mediterranean, mild year-round</p>
                        <p><strong>Midwest:</strong> Four distinct seasons, snowy winters</p>
                        <p class="text-sm text-gray-500 mt-3">
                            <span class="see-more-text line-clamp-3">
                                Invest in a good winter coat for northern schools. Southern California and Florida have weather similar to Bangladesh. Midwest winters require boots, gloves, and layers. Dorm heating is excellent. Most buildings are connected or have tunnels in cold climates.
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

@section('scripts')
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
@endsection
@endsection
