<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversityRankingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Home Route
Route::get('/', function () {
    return view('home');
})->name('home');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Password Reset Routes
Route::get('/password/reset', [\App\Http\Controllers\Auth\PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/update', [\App\Http\Controllers\Auth\PasswordResetController::class, 'update'])->name('password.update');

// University Rankings Routes
Route::get('/rankings', [UniversityRankingController::class, 'index'])->name('rankings.index');
Route::get('/rankings/subjects', [UniversityRankingController::class, 'bySubject'])->name('subjects.browse');
Route::get('/rankings/subjects/{subject}', [UniversityRankingController::class, 'bySubject'])->name('rankings.by-subject');
Route::get('/rankings/university/{slug}', [UniversityRankingController::class, 'show'])->name('rankings.show');

// University Deep-Dive Routes
Route::get('/university/{slug}/alumni', [UniversityRankingController::class, 'alumni'])->name('university.alumni');
Route::get('/university/{slug}/research', [UniversityRankingController::class, 'research'])->name('university.research');
Route::get('/university/{slug}/residential', [UniversityRankingController::class, 'residential'])->name('university.residential');
Route::get('/university/{slug}/jobs', [UniversityRankingController::class, 'jobs'])->name('university.jobs');

// Country Guides Routes
Route::get('/countries', function () {
    return view('countries.index');
})->name('countries.index');

Route::get('/countries/{slug}', function ($slug) {
    // For now, use static view. Can be replaced with controller and database later
    return view('countries.show');
})->name('countries.show');

// Blog Routes
Route::get('/blog', function () {
    return view('blog.index');
})->name('blog.index');

Route::get('/blog/{slug}', function ($slug) {
    // Placeholder for individual blog posts
    return view('blog.index');
})->name('blog.show');

// Contribute Route
Route::get('/contribute', function () {
    return view('contribute');
})->name('contribute');

// API Routes for AJAX
Route::get('/api/rankings', [UniversityRankingController::class, 'apiRankings'])->name('api.rankings');
Route::get('/api/search', [UniversityRankingController::class, 'search'])->name('api.search');

// Database Test Route (Remove after testing)
Route::get('/test-database', function() {
    $universities = \App\Models\University::whereNotNull('image_url')->take(10)->get();
    $subjects = \App\Models\Subject::where('category', 'specific')->take(10)->get();
    $stats = [
        'total_universities' => \App\Models\University::count(),
        'with_images' => \App\Models\University::whereNotNull('image_url')->count(),
        'total_subjects' => \App\Models\Subject::count(),
        'subject_links' => \Illuminate\Support\Facades\DB::table('subject_university')->count()
    ];
    return view('test-database', compact('universities', 'subjects', 'stats'));
})->name('test.database');
