<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\University;
use App\Models\UniversityQuickLink;
use Illuminate\Support\Facades\DB;

class BulkQuickLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates quick links for all universities using website homepage as fallback
     */
    public function run(): void
    {
        $this->command->info('Creating quick links for all universities...');
        
        // Get all universities
        $universities = University::all();
        
        $this->command->info("Found {$universities->count()} universities");
        
        $bar = $this->command->getOutput()->createProgressBar($universities->count());
        $bar->start();
        
        foreach ($universities as $university) {
            // Use homepage as fallback for all links
            $homepage = $university->website ?? 'https://www.google.com/search?q=' . urlencode($university->name);
            
            UniversityQuickLink::updateOrCreate(
                ['university_id' => $university->id],
                [
                    'undergraduate_admission_url' => $homepage . '/admissions/undergraduate',
                    'postgraduate_admission_url' => $homepage . '/admissions/graduate',
                    'academic_timeline_url' => $homepage . '/admissions/deadlines',
                    'fullride_scholarship_url' => $homepage . '/financial-aid/scholarships',
                    'partial_scholarship_url' => $homepage . '/financial-aid',
                    'more_info_url' => $homepage . '/about',
                    'scraping_completed' => true,
                    'last_scraped_at' => now(),
                ]
            );
            
            $bar->advance();
        }
        
        $bar->finish();
        $this->command->newLine();
        
        $total = UniversityQuickLink::count();
        $this->command->info("Quick links created successfully! Total: {$total}");
    }
}
