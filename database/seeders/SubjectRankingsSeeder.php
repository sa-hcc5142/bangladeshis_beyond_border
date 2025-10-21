<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\University;
use App\Models\SubjectRanking;
use Illuminate\Support\Facades\DB;

class SubjectRankingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Associates top 5 universities with each subject (like topuniversities.com)
     */
    public function run(): void
    {
        $this->command->info('Starting subject rankings seeding...');
        
        // Get top 10 universities by their ranking (join with university_rankings table)
        $topUniversities = DB::table('universities')
            ->leftJoin('university_rankings', 'universities.id', '=', 'university_rankings.university_id')
            ->orderBy('university_rankings.rank', 'asc')
            ->limit(10)
            ->select('universities.id', 'universities.name')
            ->get();
        
        if ($topUniversities->count() < 5) {
            // Fallback: just get first 10 universities by ID
            $topUniversities = University::limit(10)->select('id', 'name')->get();
        }
        
        $this->command->info("Found {$topUniversities->count()} top universities");
        
        // Get all subjects
        $subjects = Subject::all();
        $this->command->info("Found {$subjects->count()} subjects");
        
        foreach ($subjects as $subject) {
            // Use top 5 universities for each subject
            foreach ($topUniversities->slice(0, 5) as $index => $university) {
                $rank = $index + 1;
                
                SubjectRanking::create([
                    'subject_id' => $subject->id,
                    'university_id' => $university->id,
                    'rank' => $rank,
                    'year' => 2025,
                    'score' => max(95 - ($rank * 5), 70), // Score: 95, 90, 85, 80, 75
                ]);
                
                $this->command->info("Added {$university->name} (Rank #{$rank}) for {$subject->name}");
            }
        }
        
        $total = SubjectRanking::count();
        $this->command->info("Subject rankings seeded successfully! Total: {$total}");
    }
}
