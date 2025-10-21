<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\University;

class UniversityImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample universities with real/placeholder images and URLs
        $universities = [
            'Massachusetts Institute of Technology' => [
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/0/0c/MIT_logo.svg',
                'image_url' => 'https://images.unsplash.com/photo-1564981797816-1043664bf78d?w=800',
                'banner_image' => 'https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?w=1200',
                'thumbnail' => 'https://upload.wikimedia.org/wikipedia/commons/0/0c/MIT_logo.svg',
                'founded_year' => 1861,
                'type' => 'private',
                'student_count' => 11520,
                'international_students' => 3800,
                'admission_undergrad_url' => 'https://mitadmissions.org/apply/',
                'admission_postgrad_url' => 'https://gradadmissions.mit.edu/',
                'scholarships_url' => 'https://sfs.mit.edu/undergraduate-students/the-cost-of-attendance/financial-aid/',
                'application_timeline_url' => 'https://mitadmissions.org/apply/dates-deadlines/',
                'research_url' => 'https://www.mit.edu/research',
                'facilities_url' => 'https://studentlife.mit.edu/',
                'student_life_url' => 'https://studentlife.mit.edu/'
            ],
            'Harvard University' => [
                'logo' => 'https://upload.wikimedia.org/wikipedia/en/2/29/Harvard_shield_wreath.svg',
                'image_url' => 'https://images.unsplash.com/photo-1562774053-701939374585?w=800',
                'banner_image' => 'https://images.unsplash.com/photo-1519452575417-564c1401ecc0?w=1200',
                'thumbnail' => 'https://upload.wikimedia.org/wikipedia/en/2/29/Harvard_shield_wreath.svg',
                'founded_year' => 1636,
                'type' => 'private',
                'student_count' => 31120,
                'international_students' => 5900,
                'admission_undergrad_url' => 'https://college.harvard.edu/admissions',
                'admission_postgrad_url' => 'https://gsas.harvard.edu/admissions',
                'scholarships_url' => 'https://college.harvard.edu/financial-aid',
                'application_timeline_url' => 'https://college.harvard.edu/admissions/apply/application-timeline',
                'research_url' => 'https://www.harvard.edu/research',
                'facilities_url' => 'https://college.harvard.edu/campus-life',
                'student_life_url' => 'https://college.harvard.edu/campus-life'
            ],
            'Stanford University' => [
                'logo' => 'https://upload.wikimedia.org/wikipedia/en/b/b7/Stanford_University_seal_2003.svg',
                'image_url' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=800',
                'banner_image' => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=1200',
                'thumbnail' => 'https://upload.wikimedia.org/wikipedia/en/b/b7/Stanford_University_seal_2003.svg',
                'founded_year' => 1885,
                'type' => 'private',
                'student_count' => 17249,
                'international_students' => 3900,
                'admission_undergrad_url' => 'https://admission.stanford.edu/',
                'admission_postgrad_url' => 'https://gradadmissions.stanford.edu/',
                'scholarships_url' => 'https://financialaid.stanford.edu/',
                'application_timeline_url' => 'https://admission.stanford.edu/apply/decision-process/index.html',
                'research_url' => 'https://www.stanford.edu/research',
                'facilities_url' => 'https://residential-life.stanford.edu/',
                'student_life_url' => 'https://studentaffairs.stanford.edu/'
            ],
            'California Institute of Technology' => [
                'logo' => 'https://upload.wikimedia.org/wikipedia/en/8/8a/Seal_of_the_California_Institute_of_Technology.svg',
                'image_url' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800',
                'banner_image' => 'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?w=1200',
                'thumbnail' => 'https://upload.wikimedia.org/wikipedia/en/8/8a/Seal_of_the_California_Institute_of_Technology.svg',
                'founded_year' => 1891,
                'type' => 'private',
                'student_count' => 2397,
                'international_students' => 700,
                'admission_undergrad_url' => 'https://www.admissions.caltech.edu/',
                'admission_postgrad_url' => 'https://gradoffice.caltech.edu/admissions',
                'scholarships_url' => 'https://www.finaid.caltech.edu/',
                'application_timeline_url' => 'https://www.admissions.caltech.edu/apply/first-year-applicants',
                'research_url' => 'https://www.caltech.edu/research',
                'facilities_url' => 'https://www.caltech.edu/campus-life-events',
                'student_life_url' => 'https://www.caltech.edu/campus-life-events'
            ],
            'University of Oxford' => [
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/f/ff/Oxford-University-Circlet.svg',
                'image_url' => 'https://images.unsplash.com/photo-1577896851905-6960a77e5dfa?w=800',
                'banner_image' => 'https://images.unsplash.com/photo-1605818030850-e66c65f7c8f8?w=1200',
                'thumbnail' => 'https://upload.wikimedia.org/wikipedia/commons/f/ff/Oxford-University-Circlet.svg',
                'founded_year' => 1096,
                'type' => 'public',
                'student_count' => 26000,
                'international_students' => 9700,
                'admission_undergrad_url' => 'https://www.ox.ac.uk/admissions/undergraduate',
                'admission_postgrad_url' => 'https://www.ox.ac.uk/admissions/graduate',
                'scholarships_url' => 'https://www.ox.ac.uk/admissions/graduate/fees-and-funding',
                'application_timeline_url' => 'https://www.ox.ac.uk/admissions/undergraduate/applying-to-oxford/ucas-application',
                'research_url' => 'https://www.ox.ac.uk/research',
                'facilities_url' => 'https://www.ox.ac.uk/students',
                'student_life_url' => 'https://www.ox.ac.uk/students/life'
            ]
        ];

        foreach ($universities as $name => $data) {
            $university = University::where('name', $name)->first();
            
            if ($university) {
                $university->update($data);
                $this->command->info("Updated images and URLs for: {$name}");
            } else {
                $this->command->warn("University not found: {$name}");
            }
        }

        // Update remaining universities with placeholder images
        University::whereNull('image_url')->chunk(50, function ($universities) {
            foreach ($universities as $university) {
                $university->update([
                    'image_url' => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=800&q=80',
                    'banner_image' => 'https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?w=1200&q=80',
                    'thumbnail' => 'https://via.placeholder.com/150?text=' . urlencode(substr($university->name, 0, 3)),
                    'founded_year' => rand(1800, 2000),
                    'type' => ['public', 'private'][rand(0, 1)],
                    'student_count' => rand(5000, 50000),
                    'international_students' => rand(500, 10000),
                    'admission_undergrad_url' => $university->website ? $university->website . '/admissions' : null,
                    'admission_postgrad_url' => $university->website ? $university->website . '/graduate' : null,
                    'scholarships_url' => $university->website ? $university->website . '/financial-aid' : null,
                    'application_timeline_url' => $university->website ? $university->website . '/apply' : null,
                    'research_url' => $university->website ? $university->website . '/research' : null,
                    'facilities_url' => $university->website ? $university->website . '/campus' : null,
                    'student_life_url' => $university->website ? $university->website . '/student-life' : null,
                ]);
            }
        });

        $this->command->info('University images and URLs seeded successfully!');
    }
}
