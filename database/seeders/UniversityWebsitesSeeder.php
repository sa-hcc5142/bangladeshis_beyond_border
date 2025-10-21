<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\University;

class UniversityWebsitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $universities = [
            'massachusetts-institute-of-technology-mit' => 'https://www.mit.edu',
            'harvard-university' => 'https://www.harvard.edu',
            'stanford-university' => 'https://www.stanford.edu',
            'university-of-oxford' => 'https://www.ox.ac.uk',
            'university-of-cambridge' => 'https://www.cam.ac.uk',
            'imperial-college-london' => 'https://www.imperial.ac.uk',
            'california-institute-of-technology-caltech' => 'https://www.caltech.edu',
            'ucl-university-college-london' => 'https://www.ucl.ac.uk',
            'eth-zurich-swiss-federal-institute-of-technology' => 'https://ethz.ch',
            'national-university-of-singapore-nus' => 'https://www.nus.edu.sg',
        ];

        foreach ($universities as $slug => $website) {
            University::where('slug', $slug)->update(['website' => $website]);
        }

        $this->command->info('Updated ' . count($universities) . ' university websites.');
    }
}
