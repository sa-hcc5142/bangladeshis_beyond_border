<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\University;
use Illuminate\Support\Facades\DB;

class SubjectUniversitySeeder extends Seeder
{
    public function run()
    {
        echo "🔄 Adding subject-university relationships...\n";
        
        // Computer Science Rankings
        $this->seedSubject('computer-science', [
            ['MIT', 1, 98.5, 'World leader in AI, Machine Learning, and Robotics research'],
            ['Stanford University', 2, 97.3, 'Innovation hub in Silicon Valley with strong industry connections'],
            ['Harvard University', 3, 96.8, 'Excellence in theoretical computer science and computational biology'],
            ['University of Oxford', 4, 95.9, 'Leading European research in quantum computing and cyber security'],
            ['University of Cambridge', 5, 95.2, 'Historic strength in algorithms and programming languages'],
        ]);

        // Business & Management Rankings
        $this->seedSubject('business-management', [
            ['Harvard University', 1, 99.1, 'Top-ranked business school with prestigious MBA program'],
            ['Stanford University', 2, 97.8, 'Strong entrepreneurship and innovation focus'],
            ['Massachusetts Institute of Technology', 3, 96.5, 'Cutting-edge management science and analytics'],
            ['University of Oxford', 4, 95.7, 'Excellence in strategic management and leadership'],
        ]);

        // Medicine Rankings
        $this->seedSubject('medicine', [
            ['Harvard University', 1, 99.2, 'World-leading medical research and healthcare innovation'],
            ['University of Oxford', 2, 98.1, 'Historic excellence in clinical medicine and research'],
            ['Stanford University', 3, 97.5, 'Pioneer in precision medicine and biotechnology'],
            ['University of Cambridge', 4, 96.8, 'Strong programs in molecular medicine and genetics'],
        ]);

        // Engineering Rankings  
        $this->seedSubject('engineering-technology', [
            ['MIT', 1, 98.9, 'Excellence across all engineering disciplines'],
            ['Stanford University', 2, 97.6, 'Innovation in sustainable engineering and design'],
            ['University of Cambridge', 3, 96.4, 'Historic strength in mechanical and civil engineering'],
            ['University of Oxford', 4, 95.8, 'Leading research in materials science and bioengineering'],
        ]);

        // Economics Rankings
        $this->seedSubject('economics', [
            ['Harvard University', 1, 98.7, 'Top economics department with Nobel laureates'],
            ['MIT', 2, 97.9, 'Strong quantitative and development economics'],
            ['Stanford University', 3, 96.8, 'Excellence in economic theory and policy'],
            ['University of Oxford', 4, 95.6, 'Leading European economics research'],
        ]);

        echo "✅ Subject-university relationships added successfully!\n";
    }

    private function seedSubject($slug, $rankings)
    {
        $subject = Subject::where('slug', $slug)->first();
        
        if (!$subject) {
            echo "⚠️  Subject '{$slug}' not found, skipping...\n";
            return;
        }

        $added = 0;
        foreach ($rankings as $data) {
            $uni = University::where('name', 'LIKE', '%' . $data[0] . '%')->first();
            
            if ($uni) {
                // Check if relationship already exists
                $exists = DB::table('subject_university')
                    ->where('subject_id', $subject->id)
                    ->where('university_id', $uni->id)
                    ->where('year', 2026)
                    ->exists();

                if (!$exists) {
                    DB::table('subject_university')->insert([
                        'subject_id' => $subject->id,
                        'university_id' => $uni->id,
                        'rank' => $data[1],
                        'year' => 2026,
                        'score' => $data[2],
                        'highlights' => $data[3],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $added++;
                }
            }
        }
        
        echo "   ✓ Added {$added} universities to {$subject->name}\n";
    }
}
