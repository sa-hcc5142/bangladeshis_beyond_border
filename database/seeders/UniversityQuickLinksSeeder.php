<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\University;
use App\Models\UniversityQuickLink;

class UniversityQuickLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // MIT Example
        $mit = University::where('slug', 'massachusetts-institute-of-technology')->first();
        if ($mit) {
            UniversityQuickLink::updateOrCreate(
                ['university_id' => $mit->id],
                [
                    'undergraduate_admission_url' => 'https://www.mit.edu/admissions-aid/',
                    'postgraduate_admission_url' => 'https://oge.mit.edu/graduate-admissions/programs/masters-degrees/',
                    'academic_timeline_url' => 'https://mitadmissions.org/apply/firstyear/deadlines-requirements/',
                    'fullride_scholarship_url' => 'https://mitadmissions.org/afford/',
                    'partial_scholarship_url' => 'https://sfs.mit.edu/undergraduate-students/types-of-aid/mit-scholarship/',
                    'more_info_url' => 'https://mitadmissions.org/help/',
                    'scraping_completed' => true,
                    'last_scraped_at' => now(),
                ]
            );
        }

        // Add more universities here as examples
        // Stanford Example (add similar structure)
        $stanford = University::where('slug', 'stanford-university')->first();
        if ($stanford) {
            UniversityQuickLink::updateOrCreate(
                ['university_id' => $stanford->id],
                [
                    'undergraduate_admission_url' => 'https://admission.stanford.edu/',
                    'postgraduate_admission_url' => 'https://graddiv.stanford.edu/admissions',
                    'academic_timeline_url' => 'https://admission.stanford.edu/apply/deadlines/',
                    'fullride_scholarship_url' => 'https://financialaid.stanford.edu/',
                    'partial_scholarship_url' => 'https://financialaid.stanford.edu/undergrad/how/index.html',
                    'more_info_url' => 'https://admission.stanford.edu/contact/',
                    'scraping_completed' => true,
                    'last_scraped_at' => now(),
                ]
            );
        }
    }
}
