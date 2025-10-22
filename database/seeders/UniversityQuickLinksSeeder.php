<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\University;
use App\Models\UniversityQuickLink;

class UniversityQuickLinksSeeder extends Seeder
{
    /**
     * Run the database seeds for all 600 universities
     * Generates intelligent URLs based on official websites and common patterns
     */
    public function run(): void
    {
        $this->command->info('🔗 Generating quick links for 600 universities...');
        
        $universities = University::all();
        $created = 0;
        
        foreach ($universities as $university) {
            $baseUrl = $university->website;
            
            if (!$baseUrl) {
                $this->command->warn("⚠️  Skipping {$university->name} - no website URL");
                continue;
            }
            
            // Remove trailing slash
            $baseUrl = rtrim($baseUrl, '/');
            
            // Generate intelligent quick links
            $quickLinks = $this->generateQuickLinks($baseUrl, $university);
            
            UniversityQuickLink::updateOrCreate(
                ['university_id' => $university->id],
                $quickLinks
            );
            
            $created++;
        }
        
        $this->command->info("✅ Created/updated quick links for $created universities");
    }
    
    /**
     * Generate intelligent quick links based on university website
     */
    private function generateQuickLinks(string $baseUrl, $university): array
    {
        // Check for known specific patterns first
        $slug = $university->slug;
        $knownLinks = $this->getKnownLinks($slug, $baseUrl);
        
        if ($knownLinks) {
            return $knownLinks;
        }
        
        // Generate based on common patterns
        return $this->guessCommonPatterns($baseUrl, $university);
    }
    
    /**
     * Known accurate links for top universities
     */
    private function getKnownLinks(string $slug, string $baseUrl): ?array
    {
        $knownPatterns = [
            'massachusetts-institute-of-technology-mit' => [
                'undergraduate_admission_url' => 'https://mitadmissions.org/apply/',
                'postgraduate_admission_url' => 'https://gradadmissions.mit.edu/',
                'academic_timeline_url' => 'https://registrar.mit.edu/calendar',
                'fullride_scholarship_url' => 'https://sfs.mit.edu/undergraduate-students/types-of-aid/scholarships/',
                'partial_scholarship_url' => 'https://sfs.mit.edu/undergraduate-students/types-of-aid/scholarships/',
                'more_info_url' => $baseUrl,
            ],
            'stanford-university' => [
                'undergraduate_admission_url' => 'https://admission.stanford.edu/apply/',
                'postgraduate_admission_url' => 'https://gradadmissions.stanford.edu/',
                'academic_timeline_url' => 'https://registrar.stanford.edu/calendar',
                'fullride_scholarship_url' => 'https://financialaid.stanford.edu/undergrad/how/types/index.html',
                'partial_scholarship_url' => 'https://financialaid.stanford.edu/undergrad/how/types/index.html',
                'more_info_url' => $baseUrl,
            ],
            'harvard-university' => [
                'undergraduate_admission_url' => 'https://college.harvard.edu/admissions',
                'postgraduate_admission_url' => 'https://gsas.harvard.edu/admissions',
                'academic_timeline_url' => 'https://registrar.fas.harvard.edu/academic-calendar',
                'fullride_scholarship_url' => 'https://college.harvard.edu/financial-aid',
                'partial_scholarship_url' => 'https://college.harvard.edu/financial-aid',
                'more_info_url' => $baseUrl,
            ],
            'university-of-oxford' => [
                'undergraduate_admission_url' => 'https://www.ox.ac.uk/admissions/undergraduate',
                'postgraduate_admission_url' => 'https://www.ox.ac.uk/admissions/graduate',
                'academic_timeline_url' => 'https://www.ox.ac.uk/about/facts-and-figures/dates-of-term',
                'fullride_scholarship_url' => 'https://www.ox.ac.uk/admissions/undergraduate/fees-and-funding',
                'partial_scholarship_url' => 'https://www.ox.ac.uk/admissions/undergraduate/fees-and-funding',
                'more_info_url' => $baseUrl,
            ],
            'university-of-cambridge' => [
                'undergraduate_admission_url' => 'https://www.cam.ac.uk/admissions/undergraduate',
                'postgraduate_admission_url' => 'https://www.cam.ac.uk/admissions/postgraduate',
                'academic_timeline_url' => 'https://www.cambridgestudents.cam.ac.uk/your-course/graduate-study/your-student-status/term-dates',
                'fullride_scholarship_url' => 'https://www.undergraduate.study.cam.ac.uk/fees-and-finance',
                'partial_scholarship_url' => 'https://www.undergraduate.study.cam.ac.uk/fees-and-finance',
                'more_info_url' => $baseUrl,
            ],
            'imperial-college-london' => [
                'undergraduate_admission_url' => 'https://www.imperial.ac.uk/study/undergraduate/',
                'postgraduate_admission_url' => 'https://www.imperial.ac.uk/study/pg/',
                'academic_timeline_url' => 'https://www.imperial.ac.uk/admin-services/registry/term-dates/',
                'fullride_scholarship_url' => 'https://www.imperial.ac.uk/study/ug/fees-and-funding/',
                'partial_scholarship_url' => 'https://www.imperial.ac.uk/study/ug/fees-and-funding/',
                'more_info_url' => $baseUrl,
            ],
        ];
        
        return $knownPatterns[$slug] ?? null;
    }
    
    /**
     * Guess links based on common university website patterns
     */
    private function guessCommonPatterns(string $baseUrl, $university): array
    {
        $country = $university->country;
        
        // Common URL patterns by region
        if (in_array($country, ['United States', 'United States of America', 'USA'])) {
            return $this->generateUSPatterns($baseUrl);
        } elseif (in_array($country, ['United Kingdom', 'UK'])) {
            return $this->generateUKPatterns($baseUrl);
        } elseif ($country === 'Australia') {
            return $this->generateAustraliaPatterns($baseUrl);
        } elseif ($country === 'Canada') {
            return $this->generateCanadaPatterns($baseUrl);
        } elseif (in_array($country, ['Singapore', 'Hong Kong SAR, China'])) {
            return $this->generateAsiaPatterns($baseUrl);
        }
        
        // Default international pattern
        return $this->generateDefaultPatterns($baseUrl);
    }
    
    /**
     * US university common patterns
     */
    private function generateUSPatterns(string $baseUrl): array
    {
        return [
            'undergraduate_admission_url' => $baseUrl . '/admissions/undergraduate',
            'postgraduate_admission_url' => $baseUrl . '/admissions/graduate',
            'academic_timeline_url' => $baseUrl . '/registrar/calendar',
            'fullride_scholarship_url' => $baseUrl . '/financial-aid/scholarships',
            'partial_scholarship_url' => $baseUrl . '/financial-aid/scholarships',
            'more_info_url' => $baseUrl,
        ];
    }
    
    /**
     * UK university common patterns
     */
    private function generateUKPatterns(string $baseUrl): array
    {
        return [
            'undergraduate_admission_url' => $baseUrl . '/study/undergraduate',
            'postgraduate_admission_url' => $baseUrl . '/study/postgraduate',
            'academic_timeline_url' => $baseUrl . '/study/term-dates',
            'fullride_scholarship_url' => $baseUrl . '/study/fees-funding',
            'partial_scholarship_url' => $baseUrl . '/study/fees-funding',
            'more_info_url' => $baseUrl,
        ];
    }
    
    /**
     * Australian university common patterns
     */
    private function generateAustraliaPatterns(string $baseUrl): array
    {
        return [
            'undergraduate_admission_url' => $baseUrl . '/study/find-a-course/undergraduate',
            'postgraduate_admission_url' => $baseUrl . '/study/find-a-course/postgraduate',
            'academic_timeline_url' => $baseUrl . '/students/dates',
            'fullride_scholarship_url' => $baseUrl . '/scholarships',
            'partial_scholarship_url' => $baseUrl . '/scholarships',
            'more_info_url' => $baseUrl,
        ];
    }
    
    /**
     * Canadian university common patterns
     */
    private function generateCanadaPatterns(string $baseUrl): array
    {
        return [
            'undergraduate_admission_url' => $baseUrl . '/admissions',
            'postgraduate_admission_url' => $baseUrl . '/graduate/admissions',
            'academic_timeline_url' => $baseUrl . '/important-dates',
            'fullride_scholarship_url' => $baseUrl . '/scholarships',
            'partial_scholarship_url' => $baseUrl . '/scholarships',
            'more_info_url' => $baseUrl,
        ];
    }
    
    /**
     * Asian university common patterns
     */
    private function generateAsiaPatterns(string $baseUrl): array
    {
        return [
            'undergraduate_admission_url' => $baseUrl . '/admissions/undergraduate',
            'postgraduate_admission_url' => $baseUrl . '/admissions/graduate',
            'academic_timeline_url' => $baseUrl . '/academic-calendar',
            'fullride_scholarship_url' => $baseUrl . '/admissions/financial-aid',
            'partial_scholarship_url' => $baseUrl . '/admissions/financial-aid',
            'more_info_url' => $baseUrl,
        ];
    }
    
    /**
     * Default international patterns (fallback)
     */
    private function generateDefaultPatterns(string $baseUrl): array
    {
        return [
            'undergraduate_admission_url' => $baseUrl . '/admissions',
            'postgraduate_admission_url' => $baseUrl . '/admissions/postgraduate',
            'academic_timeline_url' => $baseUrl . '/calendar',
            'fullride_scholarship_url' => $baseUrl . '/scholarships',
            'partial_scholarship_url' => $baseUrl . '/scholarships',
            'more_info_url' => $baseUrl,
        ];
    }
}
