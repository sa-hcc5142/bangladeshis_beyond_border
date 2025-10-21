<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\University;
use App\Models\UniversityQuickLink;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ScrapeUniversityLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:university-links {--university=} {--limit=10}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape university quick action links from official websites';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $universitySlug = $this->option('university');
        $limit = (int) $this->option('limit');

        $query = University::query();
        
        if ($universitySlug) {
            $query->where('slug', $universitySlug);
        } else {
            // Get universities without quick links or incomplete data
            $query->whereDoesntHave('quickLinks')
                  ->orWhereHas('quickLinks', function($q) {
                      $q->where('scraping_completed', false);
                  })
                  ->limit($limit);
        }

        $universities = $query->get();

        if ($universities->isEmpty()) {
            $this->info('No universities found to scrape.');
            return;
        }

        $this->info("Scraping links for {$universities->count()} universities...");

        $bar = $this->output->createProgressBar($universities->count());
        $bar->start();

        foreach ($universities as $university) {
            try {
                $this->scrapeUniversityLinks($university);
                $bar->advance();
            } catch (\Exception $e) {
                $this->error("\nError scraping {$university->name}: " . $e->getMessage());
            }
        }

        $bar->finish();
        $this->newLine();
        $this->info('Scraping completed!');
    }

    /**
     * Scrape links for a single university
     */
    protected function scrapeUniversityLinks(University $university)
    {
        $websiteUrl = $university->website;
        
        if (empty($websiteUrl)) {
            $this->warn("No website URL for {$university->name}");
            return;
        }

        // Try to fetch the homepage
        try {
            $response = Http::timeout(10)->get($websiteUrl);
            $html = $response->body();
        } catch (\Exception $e) {
            $this->warn("Could not fetch {$websiteUrl}");
            return;
        }

        // Extract links using pattern matching
        $links = $this->extractLinks($html, $websiteUrl);

        // Save to database
        UniversityQuickLink::updateOrCreate(
            ['university_id' => $university->id],
            [
                'undergraduate_admission_url' => $links['undergraduate'] ?? $websiteUrl,
                'postgraduate_admission_url' => $links['postgraduate'] ?? $websiteUrl,
                'academic_timeline_url' => $links['timeline'] ?? $websiteUrl,
                'fullride_scholarship_url' => $links['fullride'] ?? $websiteUrl,
                'partial_scholarship_url' => $links['partial'] ?? $websiteUrl,
                'more_info_url' => $links['info'] ?? $websiteUrl,
                'last_scraped_at' => now(),
                'scraping_completed' => !empty($links['undergraduate']),
            ]
        );
    }

    /**
     * Extract relevant links from HTML
     */
    protected function extractLinks($html, $baseUrl)
    {
        $links = [];
        
        // Common patterns for admission pages
        $patterns = [
            'undergraduate' => [
                '/admissions?[\/\-_]?(undergraduate|undergrad|ug|bachelor)/i',
                '/undergraduate[\/\-_]?admissions?/i',
                '/apply[\/\-_]?(undergraduate|undergrad|ug)/i',
                '/bachelor[\/\-_]?admissions?/i',
                '/freshman[\/\-_]?admissions?/i',
            ],
            'postgraduate' => [
                '/admissions?[\/\-_]?(graduate|postgraduate|masters?|phd|doctoral)/i',
                '/graduate[\/\-_]?admissions?/i',
                '/apply[\/\-_]?(graduate|postgrad|masters?|phd)/i',
                '/phd[\/\-_]?admissions?/i',
                '/masters?[\/\-_]?admissions?/i',
            ],
            'timeline' => [
                '/application[\/\-_]?(deadlines?|timeline|dates?)/i',
                '/admissions?[\/\-_]?(deadlines?|timeline|calendar)/i',
                '/important[_-]?dates/i',
                '/key[_-]?dates/i',
                '/academic[_-]?calendar/i',
            ],
            'fullride' => [
                '/full[\/\-_]?(ride|tuition)[\/\-_]?scholarships?/i',
                '/scholarships?[\/\-_]?(full|complete)/i',
                '/financial[_-]?aid[\/\-_]?scholarships?/i',
                '/merit[\/\-_]?scholarships?/i',
                '/afford/i',
            ],
            'partial' => [
                '/scholarships?(?!.*full)/i',
                '/financial[_-]?aid/i',
                '/grants?/i',
                '/funding/i',
            ],
            'info' => [
                '/about[\/\-_]?us/i',
                '/about/i',
                '/contact[\/\-_]?us/i',
                '/help[\/\-_]?desk/i',
                '/information/i',
            ],
        ];

        // Extract all href attributes
        preg_match_all('/<a\s+[^>]*href=["\']([^"\']+)["\']/i', $html, $matches);
        $foundUrls = $matches[1] ?? [];

        // Match patterns
        foreach ($patterns as $type => $typePatterns) {
            foreach ($foundUrls as $url) {
                foreach ($typePatterns as $pattern) {
                    if (preg_match($pattern, $url)) {
                        $links[$type] = $this->normalizeUrl($url, $baseUrl);
                        break 2; // Move to next type
                    }
                }
            }
        }

        return $links;
    }

    /**
     * Normalize URL (convert relative to absolute)
     */
    protected function normalizeUrl($url, $baseUrl)
    {
        // Clean up the URL first
        $url = trim($url);
        
        // Already absolute URL
        if (Str::startsWith($url, ['http://', 'https://'])) {
            // Check for double URL issue (e.g., https://www.example.com//www.example.com/path)
            if (preg_match('#^(https?://[^/]+)/+(https?://|//)#', $url, $matches)) {
                // Remove the duplicate base URL
                $url = preg_replace('#^(https?://[^/]+)/+(https?://|//)#', '$1/', $url);
            }
            return $url;
        }

        $parsed = parse_url($baseUrl);
        $scheme = $parsed['scheme'] ?? 'https';
        $host = $parsed['host'] ?? '';

        // Relative URL starting with //
        if (Str::startsWith($url, '//')) {
            return $scheme . ':' . $url;
        }

        // Relative URL starting with /
        if (Str::startsWith($url, '/')) {
            return $scheme . '://' . $host . $url;
        }

        // Relative URL without /
        $path = $parsed['path'] ?? '';
        $basePath = dirname($path);
        if ($basePath === '.' || $basePath === '/') {
            $basePath = '';
        }
        
        return $scheme . '://' . $host . $basePath . '/' . $url;
    }
}
