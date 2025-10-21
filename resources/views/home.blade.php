@extends('layouts.main')

@section('title', 'Explore World Universities')

@section('content')
<!-- Fullscreen Slideshow Landing -->
<section class="relative h-screen overflow-hidden">
    <div class="absolute inset-0">
        <!-- Slide 1 - University Campus Architecture -->
        <div class="slide">
            <img src="https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=1600&auto=format&fit=crop" 
                 class="w-full h-full object-cover" alt="World-class university campus">
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 to-black/70"></div>
            <div class="absolute inset-0 flex items-center justify-center text-center px-4">
                <div class="max-w-4xl">
                    <h2 class="text-5xl md:text-6xl font-bold text-white mb-6 animate__animated animate__fadeInUp">
                        Your Future Awaits at Top Universities
                    </h2>
                    <p class="text-xl md:text-2xl text-white/90 animate__animated animate__fadeInUp animate__delay-1s">
                        Explore 600+ world-renowned institutions across 6 continents
                    </p>
                </div>
            </div>
        </div>

        <!-- Slide 2 - Study Abroad/International Students -->
        <div class="slide">
            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1600&auto=format&fit=crop" 
                 class="w-full h-full object-cover" alt="International students studying">
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 to-black/70"></div>
            <div class="absolute inset-0 flex items-center justify-center text-center px-4">
                <div class="max-w-4xl">
                    <h2 class="text-5xl md:text-6xl font-bold text-white mb-6">
                        Join a Global Community
                    </h2>
                    <p class="text-xl md:text-2xl text-white/90">
                        Connect with students from Bangladesh studying worldwide
                    </p>
                </div>
            </div>
        </div>

        <!-- Slide 3 - Library/Academic Resources -->
        <div class="slide">
            <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?q=80&w=1600&auto=format&fit=crop" 
                 class="w-full h-full object-cover" alt="University library resources">
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 to-black/70"></div>
            <div class="absolute inset-0 flex items-center justify-center text-center px-4">
                <div class="max-w-4xl">
                    <h2 class="text-5xl md:text-6xl font-bold text-white mb-6">
                        Access World-Class Resources
                    </h2>
                    <p class="text-xl md:text-2xl text-white/90">
                        Research facilities, libraries, and cutting-edge technology
                    </p>
                </div>
            </div>
        </div>

        <!-- Slide 4 - Scholarship/Financial Aid -->
        <div class="slide">
            <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?q=80&w=1600&auto=format&fit=crop" 
                 class="w-full h-full object-cover" alt="Scholarship opportunities">
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 to-black/70"></div>
            <div class="absolute inset-0 flex items-center justify-center text-center px-4">
                <div class="max-w-4xl">
                    <h2 class="text-5xl md:text-6xl font-bold text-white mb-6">
                        Discover Scholarship Opportunities
                    </h2>
                    <p class="text-xl md:text-2xl text-white/90">
                        Full rides, partial funding, and financial aid guidance
                    </p>
                </div>
            </div>
        </div>

        <!-- Slide 5 - Graduation/Success -->
        <div class="slide">
            <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=1600&auto=format&fit=crop" 
                 class="w-full h-full object-cover" alt="Graduation celebration">
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 to-black/70"></div>
            <div class="absolute inset-0 flex items-center justify-center text-center px-4">
                <div class="max-w-4xl">
                    <h2 class="text-5xl md:text-6xl font-bold text-white mb-6">
                        Your Success Story Starts Here
                    </h2>
                    <p class="text-xl md:text-2xl text-white/90">
                        Join thousands of Bangladeshi students achieving their dreams
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Button -->
    <div class="absolute bottom-12 left-1/2 transform -translate-x-1/2 z-10">
        <button onclick="document.getElementById('main-content').scrollIntoView({behavior: 'smooth'})" class="px-8 py-4 gradient-primary text-white text-lg font-semibold rounded-lg shadow-2xl smooth-transition inline-flex items-center space-x-2 hover:shadow-3xl">
            <span>Get Started</span>
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
</section>

<!-- Overview Section -->
<section id="main-content" class="py-16 bg-white dark:bg-gray-900">
    <div class="container mx-auto px-4">
        <!-- Hero Panel -->
        <div class="gradient-panel rounded-2xl p-12 mb-12">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Study abroad, simplified.
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-3xl">
                A curated hub for students exploring opportunities across the world. Browse resources, discover top colleges, learn country-specific tips, and share your story.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('rankings.index') }}" class="px-6 py-3 gradient-primary text-white font-semibold rounded-lg smooth-transition shadow-lg hover:shadow-xl">
                    Explore Rankings →
                </a>
                <a href="{{ route('subjects.browse') }}" class="px-6 py-3 bg-white dark:bg-gray-800 border-2 border-cyan-500 dark:border-cyan-400 hover:border-teal-600 dark:hover:border-teal-400 font-semibold rounded-lg smooth-transition hover:bg-cyan-50 dark:hover:bg-gray-700">
                    Browse by Subject
                </a>
            </div>
        </div>

        <!-- Feature Cards -->
        <div class="gradient-panel rounded-2xl p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg card-hover">
                    <div class="w-16 h-16 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-graduation-cap text-3xl text-emerald-600 dark:text-emerald-400"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 dark:text-white">What This Site Is</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        A comprehensive one-stop portal providing detailed university rankings, subject-specific insights, and country guides to help you make informed decisions about your education abroad.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg card-hover">
                    <div class="w-16 h-16 bg-cyan-100 dark:bg-cyan-900/30 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-lightbulb text-3xl text-cyan-600 dark:text-cyan-400"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 dark:text-white">Why We Built It</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        To reduce misinformation and save time. We've consolidated verified data from multiple sources so you can focus on applications instead of endless research.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg card-hover">
                    <div class="w-16 h-16 bg-teal-100 dark:bg-teal-900/30 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-route text-3xl text-teal-600 dark:text-teal-400"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 dark:text-white">How To Use</h3>
                    <p class="text-gray-600">
                        Select a country → Read essentials → Explore university lists → Deep-dive into specific programs. Filter by region, subject, or ranking to find your perfect match.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section with Animated Counters -->
<section id="stats-section" class="py-16 bg-gradient-to-b from-blue-50 to-white dark:from-gray-800 dark:to-gray-900">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900 dark:text-white">Our Reach</h2>
            <p class="text-xl text-gray-700 dark:text-gray-300">Comprehensive data to power your decisions</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-5xl font-bold text-blue-600 dark:text-blue-400 mb-2">
                    <span class="counter" data-target="600">0</span>+
                </div>
                <div class="text-gray-700 dark:text-gray-300 font-medium">Universities</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-bold text-indigo-600 dark:text-indigo-400 mb-2">
                    <span class="counter" data-target="56">0</span>
                </div>
                <div class="text-gray-700 dark:text-gray-300 font-medium">Subjects</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-bold text-purple-600 dark:text-purple-400 mb-2">
                    <span class="counter" data-target="6">0</span>
                </div>
                <div class="text-gray-700 dark:text-gray-300 font-medium">Global Regions</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-bold text-pink-600 dark:text-pink-400 mb-2">
                    <span class="counter" data-target="100">0</span>+
                </div>
                <div class="text-gray-700 dark:text-gray-300 font-medium">Countries</div>
            </div>
        </div>
    </div>
</section>

<script>
// Animated Counter Function
function animateCounter(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16); // 60fps
    const timer = setInterval(() => {
        start += increment;
        if (start >= target) {
            element.textContent = target;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(start);
        }
    }, 16);
}

// Intersection Observer to trigger animation when section is visible
const observerOptions = {
    threshold: 0.5, // Trigger when 50% of the section is visible
    rootMargin: '0px'
};

let hasAnimated = false;

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting && !hasAnimated) {
            hasAnimated = true;
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                animateCounter(counter, target);
            });
        }
    });
}, observerOptions);

// Observe the statistics section
document.addEventListener('DOMContentLoaded', () => {
    const statsSection = document.getElementById('stats-section');
    if (statsSection) {
        observer.observe(statsSection);
    }
});
</script>

<!-- CTA Section with Gradient Background -->
<section class="py-20 bg-gradient-to-br from-cyan-500 via-blue-600 to-purple-700 text-white relative overflow-hidden">
    <!-- Decorative overlay for depth -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
    
    <div class="container mx-auto px-4 text-center relative z-10">
        <h2 class="text-3xl md:text-5xl font-bold mb-4 drop-shadow-lg">Ready to Begin Your Journey?</h2>
        <p class="text-xl mb-10 text-white/90 max-w-2xl mx-auto">Explore rankings, subjects, and countries to find your ideal university</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('rankings.index') }}" class="px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg shadow-lg hover:shadow-2xl smooth-transition hover:scale-105 transform">
                View Rankings
            </a>
            <a href="{{ route('subjects.browse') }}" class="px-8 py-4 bg-white/20 backdrop-blur-sm hover:bg-white/30 border-2 border-white/50 font-semibold rounded-lg smooth-transition hover:scale-105 transform">
                Browse Subjects
            </a>
        </div>
    </div>
    
    <!-- Decorative gradient circles -->
    <div class="absolute -top-24 -right-24 w-64 h-64 bg-purple-400/30 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-cyan-400/30 rounded-full blur-3xl"></div>
</section>
@endsection
