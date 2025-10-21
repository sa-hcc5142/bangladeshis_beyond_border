@extends('layouts.main')

@section('title', 'Reset Password - Bangladeshis Beyond Border')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-gray-50 via-blue-50 to-emerald-50">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="mx-auto h-20 w-20 bg-gradient-primary rounded-2xl flex items-center justify-center shadow-2xl animate__animated animate__bounceIn">
                <i class="fas fa-lock-open text-white text-3xl"></i>
            </div>
            <h2 class="mt-6 text-4xl font-extrabold text-gray-900">
                Reset Your Password
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Enter your email and new password to update your account
            </p>
        </div>

        <!-- Reset Password Form -->
        <div class="mt-8 bg-white rounded-2xl shadow-2xl p-8 animate__animated animate__fadeInUp">
            <form action="{{ route('password.update') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope text-emerald-500 mr-2"></i>
                        Email Address
                    </label>
                    <div class="relative">
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            required 
                            value="{{ old('email') }}"
                            class="appearance-none relative block w-full px-4 py-3 border-2 border-gray-200 placeholder-gray-500 text-gray-900 rounded-xl focus:outline-none focus:ring-4 focus:ring-emerald-200 focus:border-emerald-500 transition @error('email') border-red-500 @enderror"
                            placeholder="you@example.com"
                        >
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- New Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-key text-emerald-500 mr-2"></i>
                        New Password
                    </label>
                    <div class="relative">
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            required 
                            class="appearance-none relative block w-full px-4 py-3 border-2 border-gray-200 placeholder-gray-500 text-gray-900 rounded-xl focus:outline-none focus:ring-4 focus:ring-emerald-200 focus:border-emerald-500 transition @error('password') border-red-500 @enderror"
                            placeholder="At least 8 characters"
                        >
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">
                        Password must be at least 8 characters long
                    </p>
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-check-double text-emerald-500 mr-2"></i>
                        Confirm New Password
                    </label>
                    <div class="relative">
                        <input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            required 
                            class="appearance-none relative block w-full px-4 py-3 border-2 border-gray-200 placeholder-gray-500 text-gray-900 rounded-xl focus:outline-none focus:ring-4 focus:ring-emerald-200 focus:border-emerald-500 transition"
                            placeholder="Re-enter your password"
                        >
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button 
                        type="submit" 
                        class="btn-animated group relative w-full flex justify-center py-3.5 px-4 border border-transparent text-lg font-bold rounded-xl text-white gradient-primary hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-emerald-300 transform hover:scale-105 smooth-transition"
                    >
                        <span class="absolute left-0 inset-y-0 flex items-center pl-4">
                            <i class="fas fa-sync-alt group-hover:animate-spin text-xl"></i>
                        </span>
                        Update Password
                    </button>
                </div>
            </form>

            <!-- Additional Links -->
            <div class="mt-6 text-center space-y-2">
                <a href="{{ route('home') }}" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium hover:underline flex items-center justify-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Home
                </a>
            </div>
        </div>

        <!-- Security Notice -->
        <div class="text-center">
            <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-4 inline-block">
                <p class="text-xs text-blue-800 flex items-center">
                    <i class="fas fa-shield-alt mr-2 text-blue-600"></i>
                    Your password will be securely encrypted and stored
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
