<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\UniversityRanking;
use App\Models\Subject;
use App\Models\SubjectRanking;
use Illuminate\Http\Request;

class UniversityRankingController extends Controller
{
    /**
     * Display the main university rankings page
     */
    public function index(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $region = $request->input('region');
        $country = $request->input('country');
        $perPage = $request->input('per_page', 30);

        // Build the query
        $query = UniversityRanking::with('university')
            ->where('year', $year)
            ->orderBy('rank', 'asc');

        // Apply filters
        if ($region) {
            $query->whereHas('university', function ($q) use ($region) {
                $q->where('region', $region);
            });
        }

        if ($country) {
            $query->whereHas('university', function ($q) use ($country) {
                $q->where('country', $country);
            });
        }

        $rankings = $query->paginate($perPage);

        // Get filter options
        $regions = University::select('region')->distinct()->pluck('region');
        $countries = University::select('country', 'region')->distinct()->get();
        $years = UniversityRanking::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');

        return view('rankings.index', compact('rankings', 'regions', 'countries', 'years', 'year'));
    }

    /**
     * Display rankings by subject
     */
    public function bySubject(Request $request, $subjectSlug = null)
    {
        $year = $request->input('year', date('Y'));
        $region = $request->input('region');
        $country = $request->input('country');
        $perPage = $request->input('per_page', 30);

        // Get all subjects organized by category
        $subjects = Subject::where('is_active', true)->get();
        
        // Group subjects by category for the browse page
        $subjectsByCategory = [
            'Arts & Humanities' => $subjects->where('category', 'specific')
                ->whereIn('slug', ['arts-humanities', 'linguistics', 'music', 'theology', 'archaeology', 'architecture', 'art-design', 'classics', 'english-literature', 'history', 'modern-languages', 'performing-arts', 'philosophy'])
                ->values(),
            'Engineering & Technology' => $subjects->where('category', 'specific')
                ->whereIn('slug', ['engineering-technology', 'chemical-engineering', 'civil-engineering', 'computer-science', 'electrical-engineering', 'mechanical-engineering', 'petroleum-engineering', 'mineral-mining-engineering'])
                ->values(),
            'Life Sciences & Medicine' => $subjects->where('category', 'specific')
                ->whereIn('slug', ['life-sciences-medicine', 'agriculture-forestry', 'anatomy-physiology', 'biological-sciences', 'dentistry', 'medicine', 'nursing', 'pharmacy-pharmacology', 'psychology', 'veterinary-science'])
                ->values(),
            'Natural Sciences' => $subjects->where('category', 'specific')
                ->whereIn('slug', ['natural-sciences', 'chemistry', 'earth-marine-sciences', 'environmental-sciences', 'geography', 'geology', 'geophysics', 'materials-sciences', 'mathematics', 'physics-astronomy'])
                ->values(),
            'Social Sciences & Management' => $subjects->where('category', 'specific')
                ->whereIn('slug', ['social-sciences-management', 'accounting-finance', 'anthropology', 'business-management', 'communication-media', 'development-studies', 'economics', 'education', 'hospitality', 'law', 'marketing', 'politics', 'sociology', 'sports', 'statistics'])
                ->values(),
        ];

        // If no subject is selected, show enhanced subject browse page
        if (!$subjectSlug) {
            return view('rankings.subjects-browse', compact('subjects', 'subjectsByCategory'));
        }

        // Find the selected subject
        $subject = Subject::where('slug', $subjectSlug)->firstOrFail();

        // Get universities for this subject using the new pivot table
        $query = $subject->universities()
            ->wherePivot('year', $year)
            ->withPivot('rank', 'score', 'highlights')
            ->orderBy('subject_university.rank', 'asc');

        // Apply filters
        if ($region) {
            $query->where('region', $region);
        }

        if ($country) {
            $query->where('country', $country);
        }

        $universities = $query->paginate($perPage);

        // Get filter options
        $regions = University::select('region')->distinct()->whereNotNull('region')->pluck('region');
        $countries = University::select('country', 'region')->distinct()->whereNotNull('country')->get();

        return view('rankings.subject-rankings', compact('universities', 'subject', 'regions', 'countries', 'year'));
    }
    
    /**
     * Search universities by name
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $year = $request->input('year', date('Y'));
        
        if (!$query) {
            return response()->json(['universities' => []]);
        }
        
        $universities = University::where('name', 'like', "%{$query}%")
            ->with(['rankings' => function($q) use ($year) {
                $q->where('year', $year);
            }])
            ->limit(10)
            ->get();
        
        return response()->json(['universities' => $universities]);
    }

    /**
     * Show university details
     */
    public function show($slug)
    {
        $university = University::with('quickLinks')
            ->where('slug', $slug)
            ->firstOrFail();
        $latestRanking = $university->latestRanking();
        $subjectRankings = $university->subjectRankings()
            ->with('subject')
            ->where('year', date('Y'))
            ->orderBy('rank', 'asc')
            ->get();

        return view('rankings.show', compact('university', 'latestRanking', 'subjectRankings'));
    }

    /**
     * API endpoint for AJAX filtering
     */
    public function apiRankings(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $region = $request->input('region');
        $country = $request->input('country');
        $perPage = $request->input('per_page', 30);

        $query = UniversityRanking::with('university')
            ->where('year', $year)
            ->orderBy('rank', 'asc');

        if ($region) {
            $query->whereHas('university', function ($q) use ($region) {
                $q->where('region', $region);
            });
        }

        if ($country) {
            $query->whereHas('university', function ($q) use ($country) {
                $q->where('country', $country);
            });
        }

        $rankings = $query->paginate($perPage);

        return response()->json($rankings);
    }

    /**
     * Show alumni and faculty page
     */
    public function alumni($slug)
    {
        $university = University::where('slug', $slug)->firstOrFail();
        return view('university.alumni', compact('university'));
    }

    /**
     * Show research opportunities page
     */
    public function research($slug)
    {
        $university = University::where('slug', $slug)->firstOrFail();
        return view('university.research', compact('university'));
    }

    /**
     * Show residential facilities page
     */
    public function residential($slug)
    {
        $university = University::where('slug', $slug)->firstOrFail();
        return view('university.residential', compact('university'));
    }

    /**
     * Show part-time jobs page
     */
    public function jobs($slug)
    {
        $university = University::where('slug', $slug)->firstOrFail();
        return view('university.jobs', compact('university'));
    }
}
