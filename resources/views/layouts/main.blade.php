<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bangladeshis Beyond Border')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        // Dark mode initialization (before page renders)
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', system-ui, -apple-system, sans-serif;
            overflow-x: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
            padding-top: 80px; /* Account for fixed navigation */
        }
        
        /* Dark mode styles - Comprehensive theme support */
        .dark {
            color-scheme: dark;
        }
        
        .dark body {
            background: linear-gradient(135deg, #1a202c 0%, #2b3544 50%, #1a202c 100%);
            color: #e2e8f0;
        }
        
        /* Card backgrounds - Dark prototype theme */
        .bg-white,
        .dark .bg-white {
            background-color: rgba(15, 32, 37, 0.8) !important;
            color: #e6f1f3 !important;
            border: 1px solid rgba(255, 255, 255, 0.06);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        }
        
        /* Text colors with proper contrast - Dark theme */
        .text-gray-900,
        .text-gray-800,
        h1, h2, h3, h4, h5, h6,
        .dark .text-gray-900,
        .dark .text-gray-800,
        .dark h1, .dark h2, .dark h3, .dark h4, .dark h5, .dark h6 {
            color: #e6f1f3 !important;
        }
        
        .text-gray-700,
        .dark .text-gray-700 {
            color: #99a9ad !important;
        }
        
        .text-gray-600,
        .text-gray-500,
        .dark .text-gray-600,
        .dark .text-gray-500 {
            color: #99a9ad !important;
        }
        
        .text-gray-400,
        .dark .text-gray-400 {
            color: #6b7b80 !important;
        }
        
        /* Border colors - Dark prototype */
        .border-gray-200,
        .border-gray-300,
        .border,
        .dark .border-gray-200,
        .dark .border-gray-300,
        .dark .border {
            border-color: rgba(255, 255, 255, 0.06) !important;
        }
        
        /* Background colors - Dark prototype */
        .bg-gray-50,
        .bg-gray-100,
        .dark .bg-gray-50,
        .dark .bg-gray-100 {
            background-color: rgba(15, 42, 48, 0.6) !important;
        }
        
        .bg-gray-200,
        .dark .bg-gray-200 {
            background-color: rgba(18, 43, 49, 0.8) !important;
        }
        
        /* Input fields - Dark prototype */
        input,
        textarea,
        select,
        .dark input,
        .dark textarea,
        .dark select {
            background-color: rgba(15, 32, 37, 0.8) !important;
            border-color: rgba(255, 255, 255, 0.06) !important;
            color: #e6f1f3 !important;
            padding: 10px 14px;
        }
        
        input::placeholder,
        textarea::placeholder,
        .dark input::placeholder,
        .dark textarea::placeholder {
            color: #99a9ad !important;
        }
        
        /* Shadow adjustments - Dark prototype */
        .shadow,
        .shadow-md,
        .shadow-lg,
        .shadow-xl,
        .shadow-2xl,
        .dark .shadow,
        .dark .shadow-md,
        .dark .shadow-lg,
        .dark .shadow-xl,
        .dark .shadow-2xl {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25) !important;
        }
        
        /* Links - Dark prototype accent */
        a:not(.gradient-primary):not(.gradient-secondary),
        .dark a:not(.gradient-primary):not(.gradient-secondary) {
            color: #38bdf8;
        }
        
        a:hover:not(.gradient-primary):not(.gradient-secondary),
        .dark a:hover:not(.gradient-primary):not(.gradient-secondary) {
            color: #7dd3fc;
        }
        
        /* Enhanced Gradient backgrounds - Dark theme from prototype */
        .gradient-panel {
            background: radial-gradient(600px 280px at 10% 0%, #1b4a53, transparent 70%),
                        linear-gradient(180deg, rgba(15, 32, 37, 0.4), rgba(15, 32, 37, 0.8));
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        }
        
        .dark .gradient-panel {
            background: radial-gradient(600px 280px at 10% 0%, #1b4a53, transparent 70%),
                        linear-gradient(180deg, rgba(15, 32, 37, 0.4), rgba(15, 32, 37, 0.8));
        }
        
        .gradient-primary {
            background: linear-gradient(135deg, #127083 0%, #38bdf8 100%);
        }
        
        .gradient-secondary {
            background: linear-gradient(135deg, #a7f3d0 0%, #38bdf8 100%);
        }
        
        /* Smooth transitions */
        .smooth-transition {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Enhanced Card hover effects - Dark prototype */
        .card-hover {
            transition: all 0.15s ease;
            position: relative;
            background: rgba(15, 34, 39, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }
        
        .card-hover::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: rgba(56, 189, 248, 0.05);
            opacity: 0;
            transition: opacity 0.15s ease;
            pointer-events: none;
        }
        
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
            background: rgba(15, 38, 48, 0.95);
        }
        
        .card-hover:hover::before {
            opacity: 1;
        }
        
        /* See more clamp - Dark prototype */
        .line-clamp {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .see-more {
            color: #8ad8ff;
            cursor: pointer;
            font-weight: 600;
        }
        
        .see-more:hover {
            text-decoration: underline;
            color: #38bdf8;
        }
        
        /* Animated button */
        .btn-animated {
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn-animated::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
            z-index: -1;
        }
        
        .btn-animated:hover::before {
            width: 300px;
            height: 300px;
        }
        
        /* Floating animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        /* Pulse animation */
        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 1; }
            100% { transform: scale(2.4); opacity: 0; }
        }
        
        .pulse-ring {
            animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        /* Logo styling - Dark prototype */
        .logo-container {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo-icon {
            width: 34px;
            height: 34px;
            background: rgba(15, 32, 37, 1);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 24px rgba(56, 189, 248, 0.4) inset;
            position: relative;
            overflow: hidden;
        }
        
        .logo-icon::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, transparent, rgba(56, 189, 248, 0.2), transparent);
            transform: translateX(-100%);
            animation: shine 3s infinite;
        }
        
        @keyframes shine {
            100% { transform: translateX(100%); }
        }
        
        .logo-text {
            font-size: 1rem;
            font-weight: 700;
            color: #e6f1f3;
            letter-spacing: 0.4px;
        }
        
        /* Modal styles - Dark prototype */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(4px);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        .modal.active {
            display: flex;
        }
        
        .modal-overlay {
            position: absolute;
            inset: 0;
        }
        
        .modal-content {
            position: relative;
            background: rgba(15, 31, 35, 0.98);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            max-width: 100%;
        }
        
        .dark .modal-content {
            background: rgba(15, 31, 35, 0.98);
        }
        
        /* Slideshow */
        @keyframes slideShow {
            0% { opacity: 0; transform: scale(1.1); }
            7% { opacity: 1; transform: scale(1); }
            25% { opacity: 1; transform: scale(1); }
            32% { opacity: 0; transform: scale(1.1); }
            100% { opacity: 0; }
        }
        
        .slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            animation: slideShow 35s infinite;
        }
        
        .slide:nth-child(1) { animation-delay: 0s; }
        .slide:nth-child(2) { animation-delay: 7s; }
        .slide:nth-child(3) { animation-delay: 14s; }
        .slide:nth-child(4) { animation-delay: 21s; }
        .slide:nth-child(5) { animation-delay: 28s; }
        
        /* Button styles - Dark prototype */
        .btn,
        button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            background: rgba(18, 49, 54, 1);
            color: #e6f1f3;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        
        .btn:hover,
        button:hover {
            filter: brightness(1.1);
        }
        
        .btn-primary {
            background: #127083;
        }
        
        .btn-ghost {
            background: transparent;
        }
        
        /* Tags and pills - Dark prototype */
        .tag,
        .pill {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            background: rgba(15, 42, 48, 1);
            color: #a9f6dc;
            font-size: 12px;
        }
        
        /* Search and form elements */
        .search-bar,
        .form-control {
            background: rgba(15, 32, 37, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.06);
            color: #e6f1f3;
            border-radius: 12px;
        }
        
        /* Accent colors from prototype */
        .accent-cyan {
            color: #38bdf8;
        }
        
        .accent-mint {
            color: #a7f3d0;
        }
        
        .text-muted {
            color: #99a9ad;
        }
        
        /* Override any remaining light backgrounds */
        .bg-gray-50,
        .bg-gray-100,
        .bg-gray-200,
        .bg-white {
            background: rgba(15, 32, 37, 0.8) !important;
            color: #e6f1f3 !important;
        }
    </style>
    @stack('styles')
</head>
<body style="background: radial-gradient(1200px 1200px at 10% -10%, #11333a66, transparent), radial-gradient(900px 900px at 100% 10%, #0b2d3360, transparent), #0c1416; color: #e6f1f3; min-height: 100vh;">
    <!-- Top Navigation -->
    <nav style="background: linear-gradient(180deg, rgba(15, 32, 37, 0.85) 0%, rgba(15, 32, 37, 0.55) 100%); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(255, 255, 255, 0.06);" class="text-white shadow-2xl fixed top-0 left-0 right-0 z-[9999]">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-20">
                <!-- Logo & Brand -->
                <a href="{{ route('home') }}" class="logo-container smooth-transition hover:scale-105">
                    <div class="logo-icon">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div class="hidden md:block">
                        <div class="text-white font-bold text-xl tracking-tight">Bangladeshis Beyond Border</div>
                        <div class="text-emerald-200 text-xs font-medium">Your Gateway to Global Education</div>
                    </div>
                    <div class="md:hidden">
                        <div class="text-white font-bold text-lg">BBB</div>
                    </div>
                </a>
                
                <!-- Navigation Links -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="group relative px-3 py-2 smooth-transition">
                        <span class="relative z-10 font-medium group-hover:text-emerald-300">Home</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald-300 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('rankings.index') }}" class="group relative px-3 py-2 smooth-transition">
                        <span class="relative z-10 font-medium group-hover:text-emerald-300">Rankings</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald-300 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('subjects.browse') }}" class="group relative px-3 py-2 smooth-transition">
                        <span class="relative z-10 font-medium group-hover:text-emerald-300">By Subject</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald-300 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('countries.index') }}" class="group relative px-3 py-2 smooth-transition">
                        <span class="relative z-10 font-medium group-hover:text-emerald-300">Countries</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald-300 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('blog.index') }}" class="group relative px-3 py-2 smooth-transition">
                        <span class="relative z-10 font-medium group-hover:text-emerald-300">Blog</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald-300 group-hover:w-full transition-all duration-300"></span>
                    </a>
                </div>
                
                <!-- Auth Buttons -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('contribute') }}" class="hidden lg:block group relative px-3 py-2 smooth-transition">
                        <span class="relative z-10 font-medium group-hover:text-emerald-300">Contribute</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-emerald-300 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="https://github.com/sa-hcc5142/bangladeshis_beyond_border" target="_blank" class="hidden md:block p-2.5 rounded-xl hover:bg-white hover:bg-opacity-20 smooth-transition group">
                        <i class="fab fa-github text-lg group-hover:scale-110 transition-transform"></i>
                    </a>
                    @guest
                        <button onclick="openModal('authModal')" class="btn-animated px-6 py-2.5 bg-white bg-opacity-20 backdrop-blur-md text-white rounded-xl font-semibold hover:bg-opacity-30 smooth-transition border border-white border-opacity-30">
                            <i class="fas fa-user-circle mr-2"></i>
                            <span class="hidden md:inline">Login</span>
                        </button>
                    @else
                        <div class="relative group">
                            <button class="flex items-center space-x-2 px-4 py-2 bg-white bg-opacity-20 backdrop-blur-md rounded-xl hover:bg-opacity-30 smooth-transition">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=10b981&color=fff" class="w-8 h-8 rounded-full border-2 border-white" alt="Avatar">
                                <span class="hidden md:inline font-medium">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-sm"></i>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-2xl overflow-hidden opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2">
                                <a href="#" class="block px-4 py-3 hover:bg-emerald-50 transition">
                                    <i class="fas fa-user mr-2 text-emerald-600"></i>
                                    <span class="text-gray-700">My Profile</span>
                                </a>
                                <a href="#" class="block px-4 py-3 hover:bg-emerald-50 transition">
                                    <i class="fas fa-bookmark mr-2 text-emerald-600"></i>
                                    <span class="text-gray-700">Saved</span>
                                </a>
                                <a href="#" class="block px-4 py-3 hover:bg-emerald-50 transition">
                                    <i class="fas fa-cog mr-2 text-emerald-600"></i>
                                    <span class="text-gray-700">Settings</span>
                                </a>
                                <hr>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-3 hover:bg-red-50 transition text-red-600">
                                        <i class="fas fa-sign-out-alt mr-2"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                    
                    <!-- Mobile Menu Toggle -->
                    <button onclick="toggleMobileMenu()" class="lg:hidden p-2 rounded-lg hover:bg-white hover:bg-opacity-20">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobileMenu" class="lg:hidden hidden bg-white bg-opacity-10 backdrop-blur-lg">
                <div class="container mx-auto px-4 py-4 space-y-2">
                    <a href="{{ route('home') }}" class="block px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 smooth-transition">Home</a>
                    <a href="{{ route('rankings.index') }}" class="block px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 smooth-transition">Rankings</a>
                    <a href="{{ route('subjects.browse') }}" class="block px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 smooth-transition">By Subject</a>
                    <a href="{{ route('countries.index') }}" class="block px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 smooth-transition">Countries</a>
                    <a href="{{ route('blog.index') }}" class="block px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 smooth-transition">Blog</a>
                    <a href="{{ route('contribute') }}" class="block px-4 py-3 rounded-lg hover:bg-white hover:bg-opacity-20 smooth-transition">Contribute</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Edit This Page CTA (Separate from Footer) -->
    <div style="background: rgba(30, 58, 66, 0.6); border-top: 1px solid rgba(56, 189, 248, 0.15); border-bottom: 1px solid rgba(56, 189, 248, 0.15);" class="text-white mt-20 mb-8">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="mb-4 md:mb-0 text-center md:text-left">
                    <h3 class="text-xl font-bold mb-1" style="color: #ffffff;">Spotted an error or want to improve this page?</h3>
                    <p style="color: #99a9ad;">This project is open source. You can contribute improvements directly on GitHub.</p>
                </div>
                <a href="https://github.com/sa-hcc5142/bangladeshis_beyond_border" target="_blank" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg smooth-transition inline-flex items-center whitespace-nowrap shadow-lg">
                    <i class="fab fa-github mr-2"></i>
                    Edit on GitHub
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer style="background: linear-gradient(135deg, rgba(15, 32, 37, 0.95) 0%, rgba(17, 51, 58, 0.95) 100%); backdrop-filter: blur(10px); border-top: 1px solid rgba(56, 189, 248, 0.2);" class="text-white">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4" style="color: #ffffff;">About</h3>
                    <p style="color: #99a9ad;">Comprehensive university rankings and insights for students worldwide.</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4" style="color: #ffffff;">Quick Links</h3>
                    <ul class="space-y-2" style="color: #99a9ad;">
                        <li><a href="{{ route('rankings.index') }}" class="transition" style="color: #99a9ad;" onmouseover="this.style.color='#38bdf8'" onmouseout="this.style.color='#99a9ad'">Rankings</a></li>
                        <li><a href="{{ route('subjects.browse') }}" class="transition" style="color: #99a9ad;" onmouseover="this.style.color='#38bdf8'" onmouseout="this.style.color='#99a9ad'">By Subject</a></li>
                        <li><a href="{{ route('countries.index') }}" class="transition" style="color: #99a9ad;" onmouseover="this.style.color='#38bdf8'" onmouseout="this.style.color='#99a9ad'">Countries</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4" style="color: #ffffff;">Resources</h3>
                    <ul class="space-y-2" style="color: #99a9ad;">
                        <li><a href="{{ route('blog.index') }}" class="transition" style="color: #99a9ad;" onmouseover="this.style.color='#38bdf8'" onmouseout="this.style.color='#99a9ad'">Blog</a></li>
                        <li><a href="{{ route('contribute') }}" class="transition" style="color: #99a9ad;" onmouseover="this.style.color='#38bdf8'" onmouseout="this.style.color='#99a9ad'">Contribute</a></li>
                        <li><a href="#" class="transition" style="color: #99a9ad;" onmouseover="this.style.color='#38bdf8'" onmouseout="this.style.color='#99a9ad'">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4" style="color: #ffffff;">Connect</h3>
                    <div class="flex space-x-4 text-2xl">
                        <a href="https://github.com/sa-hcc5142/bangladeshis_beyond_border" target="_blank" class="transition" style="color: #99a9ad;" onmouseover="this.style.color='#38bdf8'" onmouseout="this.style.color='#99a9ad'"><i class="fab fa-github"></i></a>
                        <a href="#" class="transition" style="color: #99a9ad;" onmouseover="this.style.color='#38bdf8'" onmouseout="this.style.color='#99a9ad'"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="transition" style="color: #99a9ad;" onmouseover="this.style.color='#38bdf8'" onmouseout="this.style.color='#99a9ad'"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Copyright Bar at Bottom -->
        <div style="background: rgba(26, 43, 49, 0.8); border-top: 1px solid rgba(56, 189, 248, 0.15);" class="py-4">
            <div class="container mx-auto px-4">
                <p class="text-center" style="color: #99a9ad; margin: 0;">© 2025 World University Rankings. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Auth Modal -->
    <div id="authModal" class="modal">
        <div class="bg-white rounded-2xl shadow-2xl max-w-5xl w-full mx-4 max-h-[90vh] overflow-y-auto animate__animated animate__fadeInUp">
            <div class="flex items-center justify-between p-6 border-b gradient-primary">
                <h2 class="text-3xl font-bold text-white">Welcome to Bangladeshis Beyond Border</h2>
                <button onclick="closeModal('authModal')" class="text-white hover:text-emerald-200 smooth-transition">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Login Form -->
                    <div class="bg-gradient-to-br from-emerald-50 to-blue-50 rounded-xl p-8 shadow-lg">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-primary rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-sign-in-alt text-white text-xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800">Login</h3>
                        </div>
                        <form action="{{ route('login') }}" method="POST" id="loginForm">
                            @csrf
                            <div class="mb-5">
                                <label class="block text-sm font-semibold mb-2 text-gray-700">Email Address</label>
                                <div class="relative">
                                    <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <input type="email" name="email" required class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-emerald-200 focus:border-emerald-500 transition" placeholder="you@example.com" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label class="block text-sm font-semibold mb-2 text-gray-700">Password</label>
                                <div class="relative">
                                    <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <input type="password" name="password" required class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-emerald-200 focus:border-emerald-500 transition" placeholder="••••••••">
                                </div>
                                @error('password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex items-center justify-between mb-6">
                                <label class="flex items-center group cursor-pointer">
                                    <input type="checkbox" name="remember" class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                                    <span class="ml-2 text-sm text-gray-700 group-hover:text-emerald-600 transition">Remember me</span>
                                </label>
                                <a href="{{ route('password.reset') }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-700 hover:underline">Forgot password?</a>
                            </div>
                            <button type="submit" class="btn-animated w-full gradient-primary text-white py-3.5 rounded-xl font-bold text-lg hover:shadow-2xl smooth-transition transform hover:scale-105">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Login to Continue
                            </button>
                        </form>
                        <div class="mt-6 text-center">
                            <p class="text-sm text-gray-600">or login with</p>
                            <div class="flex gap-3 mt-3">
                                <button class="flex-1 py-2.5 bg-white border-2 border-gray-200 rounded-xl hover:border-emerald-500 hover:shadow-lg smooth-transition">
                                    <i class="fab fa-google text-red-500 mr-2"></i>
                                    Google
                                </button>
                                <button class="flex-1 py-2.5 bg-white border-2 border-gray-200 rounded-xl hover:border-blue-500 hover:shadow-lg smooth-transition">
                                    <i class="fab fa-facebook text-blue-600 mr-2"></i>
                                    Facebook
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Register Form -->
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-xl p-8 shadow-lg">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-secondary rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-user-plus text-white text-xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800">Create Account</h3>
                        </div>
                        <form action="{{ route('register') }}" method="POST" id="registerForm">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-semibold mb-2 text-gray-700">Full Name</label>
                                <div class="relative">
                                    <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <input type="text" name="name" required class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition" placeholder="Your full name" value="{{ old('name') }}">
                                </div>
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold mb-2 text-gray-700">Email Address</label>
                                <div class="relative">
                                    <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <input type="email" name="email" required class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition" placeholder="you@example.com" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold mb-2 text-gray-700">Password</label>
                                <div class="relative">
                                    <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <input type="password" name="password" required class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition" placeholder="At least 8 characters">
                                </div>
                                @error('password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="block text-sm font-semibold mb-2 text-gray-700">Confirm Password</label>
                                <div class="relative">
                                    <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <input type="password" name="password_confirmation" required class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition" placeholder="Confirm password">
                                </div>
                            </div>
                            <button type="submit" class="btn-animated w-full gradient-secondary text-white py-3.5 rounded-xl font-bold text-lg hover:shadow-2xl smooth-transition transform hover:scale-105">
                                <i class="fas fa-user-plus mr-2"></i>
                                Create My Account
                            </button>
                        </form>
                        <p class="text-xs text-gray-500 text-center mt-4">
                            By creating an account, you agree to our <a href="#" class="text-blue-600 hover:underline">Terms</a> & <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toastContainer" class="fixed bottom-6 right-6 space-y-3 z-50"></div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="fixed top-6 right-6 z-50 animate__animated animate__fadeInDown">
            <div class="bg-gradient-to-r from-emerald-500 to-green-600 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 max-w-md">
                <div class="flex-shrink-0 w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-check text-xl"></i>
                </div>
                <div class="flex-1">
                    <p class="font-semibold">Success!</p>
                    <p class="text-sm opacity-90">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="hover:bg-white hover:bg-opacity-20 p-2 rounded-lg transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const successAlert = document.querySelector('.fixed.top-6');
                if(successAlert) {
                    successAlert.classList.add('animate__fadeOutUp');
                    setTimeout(() => successAlert.remove(), 500);
                }
            }, 5000);
        </script>
    @endif

    @if(session('error'))
        <div class="fixed top-6 right-6 z-50 animate__animated animate__fadeInDown">
            <div class="bg-gradient-to-r from-red-500 to-pink-600 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 max-w-md">
                <div class="flex-shrink-0 w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-xl"></i>
                </div>
                <div class="flex-1">
                    <p class="font-semibold">Error!</p>
                    <p class="text-sm opacity-90">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="hover:bg-white hover:bg-opacity-20 p-2 rounded-lg transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const errorAlert = document.querySelector('.fixed.top-6');
                if(errorAlert) {
                    errorAlert.classList.add('animate__fadeOutUp');
                    setTimeout(() => errorAlert.remove(), 5000);
                }
            }, 5000);
        </script>
    @endif

    @if($errors->any())
        <script>
            // Auto-open auth modal if there are validation errors
            document.addEventListener('DOMContentLoaded', function() {
                openModal('authModal');
            });
        </script>
    @endif

    <script>
        // Dark Mode Toggle
        function toggleTheme() {
            const html = document.documentElement;
            const icon = document.getElementById('themeIcon');
            
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.theme = 'light';
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            } else {
                html.classList.add('dark');
                localStorage.theme = 'dark';
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }
        }
        
        // Initialize theme icon on page load
        document.addEventListener('DOMContentLoaded', function() {
            const icon = document.getElementById('themeIcon');
            if (document.documentElement.classList.contains('dark')) {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }
        });
        
        // Modal Management
        function openModal(id) {
            document.getElementById(id).classList.add('active');
        }
        
        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }
        
        // Close modal on outside click
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal(modal.id);
            });
        });
        
        // Toast Notifications
        function showToast(message) {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = 'bg-gray-900 text-white px-6 py-3 rounded-lg shadow-lg transform transition-all duration-300';
            toast.textContent = message;
            container.appendChild(toast);
            
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(20px)';
                setTimeout(() => container.removeChild(toast), 300);
            }, 3000);
        }
        
        // Theme Toggle
        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
            const isDark = document.documentElement.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            showToast(isDark ? 'Dark mode enabled' : 'Light mode enabled');
        }
        
        // Load saved theme
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
    
    @stack('scripts')
</body>
</html>
