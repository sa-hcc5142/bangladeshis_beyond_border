<?php

namespace App\Console\Commands;

use App\Models\University;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class RetryFailedCities extends Command
{
    protected $signature = 'universities:retry-failed';
    protected $description = 'Retry fetching cities for universities that failed initially';

    // Manual mapping for known difficult cases
    private $manualMappings = [
        'The University of Queensland' => 'Brisbane',
        'The Hong Kong University of Science and Technology' => 'Hong Kong',
        'University of Science and Technology of China' => 'Hefei',
        'Khalifa University of Science and Technology' => 'Abu Dhabi',
        'Universidad de Los Andes Colombia' => 'Bogotá',
        'Eberhard Karls Universität Tübingen' => 'Tübingen',
        'Norwegian University of Science And Technology' => 'Trondheim',
        'City St George\'s, University of London' => 'London',
        'Huazhong University of Science and Technology' => 'Wuhan',
        'Bauman Moscow State Technical University' => 'Moscow',
        'National Taiwan University of Science and Technology (Taiwan Tech)' => 'Taipei',
        'Università degli Studi di Roma - Tor Vergata' => 'Rome',
        'Daegu Gyeongbuk Institute of Science and Technology (DGIST)' => 'Daegu',
        'National University of Sciences And Technology (NUST) Islamabad' => 'Islamabad',
        'Southeast University, China' => 'Nanjing',
        'Lappeenranta-Lahti University of Technology LUT' => 'Lappeenranta',
        'University at Buffalo SUNY' => 'Buffalo',
        'National Research University Higher School of Economics (HSE, Moscow)' => 'Moscow',
        'Moscow Institute of Physics and Technology State University' => 'Moscow',
        'University of Science and Technology Beijing' => 'Beijing',
        'Universidad de Santiago de Chile - USACH' => 'Santiago',
        'Shoolini University of Biotechnology and Management Sciences' => 'Solan',
        'INTI International University' => 'Nilai',
        'Pontificia Universidad Católica Argentina Santa María de los Buenos Aires - UCA' => 'Buenos Aires',
        'Universidad Austral - Argentina' => 'Buenos Aires',
        'University of Electronic Science and Technology of China' => 'Chengdu',
        'Universiti Teknologi MARA - UiTM' => 'Shah Alam',
        'Université Paul Sabatier Toulouse III' => 'Toulouse',
        'Asia Pacific University of Technology and Innovation (APU) Malaysia' => 'Kuala Lumpur',
        'Management and Science University - MSU Malaysia' => 'Shah Alam',
    ];

    public function handle()
    {
        $failed = University::where('city', 'Unknown')->orWhereNull('city')->get();

        if ($failed->isEmpty()) {
            $this->info('✅ All universities have city data!');
            return 0;
        }

        $this->info("🔄 Retrying {$failed->count()} universities with improved strategies...\n");

        $bar = $this->output->createProgressBar($failed->count());
        $bar->start();

        $success = 0;
        $manual = 0;
        $failed_count = 0;

        foreach ($failed as $uni) {
            // Try manual mapping first
            if (isset($this->manualMappings[$uni->name])) {
                $uni->city = $this->manualMappings[$uni->name];
                $uni->save();
                $manual++;
                $this->newLine();
                $this->line("✓ [MANUAL] {$uni->name} → {$uni->city}");
                $bar->advance();
                continue;
            }

            // Try multiple search strategies
            $city = $this->tryMultipleStrategies($uni->name, $uni->country);

            if ($city) {
                $uni->city = $city;
                $uni->save();
                $success++;
                $this->newLine();
                $this->line("✓ [API] {$uni->name} → {$city}");
            } else {
                $failed_count++;
                $this->newLine();
                $this->warn("✗ Still failed: {$uni->name}");
            }

            $bar->advance();
            sleep(1);
        }

        $bar->finish();
        $this->newLine(2);

        $this->table(
            ['Status', 'Count'],
            [
                ['Manual Mapping', $manual],
                ['API Success', $success],
                ['Still Failed', $failed_count],
                ['Total', $failed->count()],
            ]
        );

        if ($failed_count > 0) {
            $this->newLine();
            $this->warn("⚠️  {$failed_count} universities still need manual update.");
        } else {
            $this->newLine();
            $this->info("🎉 All universities now have city data!");
        }

        return 0;
    }

    private function tryMultipleStrategies($name, $country)
    {
        $strategies = [
            // Strategy 1: Just the main name + country
            function($name, $country) {
                $clean = preg_replace('/\(.*?\)/', '', $name);
                $clean = trim($clean);
                return $this->searchNominatim($clean, $country);
            },
            
            // Strategy 2: Extract city from abbreviation in parentheses
            function($name, $country) {
                if (preg_match('/\(([^)]+)\)/', $name, $matches)) {
                    $abbrev = $matches[1];
                    return $this->searchNominatim($abbrev, $country);
                }
                return null;
            },
            
            // Strategy 3: Remove "University of Science and Technology" clutter
            function($name, $country) {
                $clean = str_replace(['University of Science and Technology', 'University of Science And Technology'], '', $name);
                $clean = trim($clean);
                return $this->searchNominatim($clean, $country);
            },
            
            // Strategy 4: Try just the city name if it's in the university name
            function($name, $country) {
                // Common patterns: "National University of {CITY}"
                if (preg_match('/of\s+([A-Z][a-z]+)/', $name, $matches)) {
                    return $this->searchNominatim($matches[1], $country);
                }
                return null;
            },
        ];

        foreach ($strategies as $strategy) {
            $city = $strategy($name, $country);
            if ($city) return $city;
            usleep(500000); // 0.5 second delay between strategies
        }

        return null;
    }

    private function searchNominatim($query, $country)
    {
        try {
            $res = Http::withHeaders(['User-Agent' => 'LaravelApp/1.0'])
                ->timeout(10)
                ->get('https://nominatim.openstreetmap.org/search', [
                    'q' => "{$query}, {$country}",
                    'format' => 'json',
                    'limit' => 1,
                    'addressdetails' => 1,
                ]);

            if ($res->ok() && count($res->json()) > 0) {
                $addr = $res->json()[0]['address'] ?? [];
                return $addr['city'] 
                    ?? $addr['town'] 
                    ?? $addr['village'] 
                    ?? $addr['municipality'] 
                    ?? $addr['county'] 
                    ?? null;
            }
        } catch (\Exception $e) {
            // Silently fail and try next strategy
        }

        return null;
    }
}
