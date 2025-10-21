<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\University;
use Illuminate\Support\Facades\Storage;

class UpdateCitiesFromQS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'universities:update-cities-from-qs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch city data from QS Rankings and update both database and CSV file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🌍 Fetching city data from QS World Rankings...');
        
        // Fetch city data from QS Rankings API/website
        $cityData = $this->fetchCityDataFromQS();
        
        if (empty($cityData)) {
            $this->error('❌ Failed to fetch city data from QS Rankings');
            return 1;
        }
        
        $this->info("✓ Fetched data for " . count($cityData) . " universities");
        
        // Update database
        $this->info('📊 Updating database...');
        $dbUpdated = $this->updateDatabase($cityData);
        $this->info("✓ Updated {$dbUpdated} universities in database");
        
        // Update CSV file
        $this->info('📄 Updating CSV file...');
        $csvUpdated = $this->updateCsvFile($cityData);
        $this->info("✓ Updated CSV file with city data");
        
        $this->info('🎉 All done! Cities are now permanently stored in both database and CSV.');
        
        return 0;
    }

    /**
     * Fetch city data from QS Rankings
     */
    private function fetchCityDataFromQS()
    {
        $cityData = [];
        
        try {
            $this->info('🔍 Scraping QS Rankings website...');
            
            // Get universities from database
            $universities = University::orderBy('id')->get();
            $bar = $this->output->createProgressBar($universities->count());
            $bar->start();
            
            foreach ($universities as $uni) {
                // Scrape from QS website
                $city = $this->scrapeCityFromQS($uni->name, $uni->slug);
                
                if ($city && $city !== 'Unknown') {
                    $cityData[$uni->name] = $city;
                    $this->newLine();
                    $this->line("✓ {$uni->name} → {$city}");
                } else {
                    $this->newLine();
                    $this->warn("✗ No city found: {$uni->name}");
                }
                
                $bar->advance();
                usleep(500000); // 0.5 second delay to avoid rate limiting
            }
            
            $bar->finish();
            $this->newLine();
            
            return $cityData;
            
        } catch (\Exception $e) {
            $this->error("Error fetching QS data: " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Scrape city from QS university profile page
     */
    private function scrapeCityFromQS($name, $slug)
    {
        try {
            $url = "https://www.topuniversities.com/universities/" . $slug;
            
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            ])->timeout(15)->get($url);
            
            if (!$response->successful()) {
                return null;
            }
            
            $html = $response->body();
            
            // Pattern 1: Look for city/town in address section
            if (preg_match('/class="location"[^>]*>([^<]+)</i', $html, $matches)) {
                $location = trim(strip_tags($matches[1]));
                $parts = explode(',', $location);
                if (count($parts) > 0) {
                    return trim($parts[0]);
                }
            }
            
            // Pattern 2: Look for address in structured JSON-LD data
            if (preg_match('/"address"\s*:\s*{[^}]*"addressLocality"\s*:\s*"([^"]+)"/i', $html, $matches)) {
                return trim($matches[1]);
            }
            
            // Pattern 3: Look for city in any data-city attribute
            if (preg_match('/data-city="([^"]+)"/i', $html, $matches)) {
                return trim($matches[1]);
            }
            
            // Pattern 4: Look for location field with class
            if (preg_match('/class="[^"]*city[^"]*"[^>]*>([^<]+)</i', $html, $matches)) {
                return trim(strip_tags($matches[1]));
            }
            
            // Pattern 5: Search for location with specific div structure
            if (preg_match('/<div[^>]*class="[^"]*location[^"]*"[^>]*>.*?<[^>]*>([^<]+)<\/[^>]*>/is', $html, $matches)) {
                $location = trim(strip_tags($matches[1]));
                if (!empty($location) && $location !== 'Location') {
                    $parts = explode(',', $location);
                    return trim($parts[0]);
                }
            }
            
            // Pattern 6: Try to find in overview section
            if (preg_match('/City<\/[^>]+>\s*<[^>]+>([^<]+)</i', $html, $matches)) {
                return trim(strip_tags($matches[1]));
            }
            
            return null;
            
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Fallback: Get city data from Nominatim API
     */
    private function getFallbackCityData()
    {
        $this->info('Using Nominatim API as fallback...');
        $cityData = [];
        
        $universities = University::where('city', 'Unknown')
            ->orWhereNull('city')
            ->limit(100)
            ->get();
        
        $bar = $this->output->createProgressBar($universities->count());
        $bar->start();
        
        foreach ($universities as $uni) {
            $city = $this->getCityFromNominatim($uni->name, $uni->country);
            if ($city) {
                $cityData[$uni->name] = $city;
            }
            $bar->advance();
            sleep(1); // Rate limiting
        }
        
        $bar->finish();
        $this->newLine();
        
        return $cityData;
    }

    /**
     * Get city from Nominatim API
     */
    private function getCityFromNominatim($name, $country)
    {
        try {
            $cleanName = preg_replace('/\s*\([^)]*\)/', '', $name);
            $cleanName = str_replace(['University of', 'University'], '', $cleanName);
            $cleanName = trim($cleanName);
            
            $response = Http::withHeaders(['User-Agent' => 'LaravelApp/1.0'])
                ->timeout(10)
                ->get('https://nominatim.openstreetmap.org/search', [
                    'q' => "{$cleanName}, {$country}",
                    'format' => 'json',
                    'limit' => 1,
                    'addressdetails' => 1,
                ]);

            if ($response->successful() && count($response->json()) > 0) {
                $address = $response->json()[0]['address'] ?? [];
                return $address['city'] 
                    ?? $address['town'] 
                    ?? $address['village'] 
                    ?? $address['municipality'] 
                    ?? $address['county'] 
                    ?? null;
            }
            
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Update database with city data
     */
    private function updateDatabase($cityData)
    {
        $updated = 0;
        
        foreach ($cityData as $universityName => $city) {
            $count = University::where('name', $universityName)
                ->update(['city' => $city]);
            $updated += $count;
        }
        
        return $updated;
    }

    /**
     * Update CSV file with city data
     */
    private function updateCsvFile($cityData)
    {
        $csvPath = database_path('seeders/data/qs_rankings_2025.csv');
        
        if (!file_exists($csvPath)) {
            $this->error("CSV file not found: {$csvPath}");
            return false;
        }
        
        // Read CSV
        $rows = [];
        $header = null;
        
        if (($handle = fopen($csvPath, 'r')) !== false) {
            $header = fgetcsv($handle);
            $rows[] = $header;
            
            // Find city column index (or add if doesn't exist)
            $cityIndex = array_search('city', $header);
            if ($cityIndex === false) {
                $header[] = 'city';
                $cityIndex = count($header) - 1;
                $rows[0] = $header;
            }
            
            // Find name column index
            $nameIndex = array_search('name', $header);
            if ($nameIndex === false) {
                $nameIndex = array_search('university', $header);
            }
            
            // Read and update rows
            while (($row = fgetcsv($handle)) !== false) {
                $universityName = $row[$nameIndex] ?? '';
                
                // Update city if we have data for this university
                if (isset($cityData[$universityName])) {
                    $row[$cityIndex] = $cityData[$universityName];
                }
                
                $rows[] = $row;
            }
            
            fclose($handle);
        }
        
        // Write back to CSV
        if (($handle = fopen($csvPath, 'w')) !== false) {
            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
            return true;
        }
        
        return false;
    }
}
