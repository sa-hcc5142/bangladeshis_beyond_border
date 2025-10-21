<?php

namespace App\Console\Commands;

use App\Models\University;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FetchCityData extends Command
{
    protected $signature = 'universities:fetch-cities 
                            {--limit=50 : Number of universities to process}
                            {--offset=0 : Offset to start from}';

    protected $description = 'Fetch city information for universities using Nominatim API';

    public function handle()
    {
        $limit = (int) $this->option('limit');
        $offset = (int) $this->option('offset');

        $universities = University::where('city', 'Unknown')
            ->orWhereNull('city')
            ->skip($offset)
            ->take($limit)
            ->get();

        if ($universities->isEmpty()) {
            $this->info('✅ No universities to update. All done!');
            return 0;
        }

        $this->info("📍 Processing {$universities->count()} universities (offset: {$offset})...\n");

        $bar = $this->output->createProgressBar($universities->count());
        $bar->start();

        $success = 0;
        $fail = 0;

        foreach ($universities as $uni) {
            try {
                $city = $this->getCity($uni->name, $uni->country);

                if ($city) {
                    $uni->city = $city;
                    $uni->save();
                    $success++;
                    
                    $this->newLine();
                    $this->line("✓ {$uni->name} → {$city}, {$uni->country}");
                } else {
                    $fail++;
                    $this->newLine();
                    $this->warn("✗ No city found: {$uni->name}");
                }

                $bar->advance();
                sleep(1);

            } catch (\Exception $e) {
                $fail++;
                $this->newLine();
                $this->error("✗ Error: {$uni->name}");
                $bar->advance();
            }
        }

        $bar->finish();
        $this->newLine(2);

        $this->table(
            ['Status', 'Count'],
            [
                ['Success', $success],
                ['Failed', $fail],
                ['Total', $universities->count()],
            ]
        );

        $left = University::where('city', 'Unknown')->orWhereNull('city')->count();

        if ($left > 0) {
            $this->info("\n📌 {$left} universities remaining.");
            $this->info("Next: php artisan universities:fetch-cities --offset=" . ($offset + $limit));
        } else {
            $this->info("\n🎉 All done!");
        }

        return 0;
    }

    private function getCity($name, $country)
    {
        try {
            $clean = preg_replace('/\s*\([^)]*\)/', '', $name);
            $clean = str_replace(['University of', 'University'], '', $clean);
            $clean = trim($clean);
            
            $res = Http::withHeaders(['User-Agent' => 'LaravelApp/1.0'])
                ->timeout(10)
                ->get('https://nominatim.openstreetmap.org/search', [
                    'q' => "{$clean}, {$country}",
                    'format' => 'json',
                    'limit' => 1,
                    'addressdetails' => 1,
                ]);

            if ($res->ok() && count($res->json()) > 0) {
                $addr = $res->json()[0]['address'] ?? [];
                $city = $addr['city'] ?? $addr['town'] ?? $addr['village'] ?? $addr['municipality'] ?? $addr['county'] ?? null;
                if ($city) return $city;
            }

            $res = Http::withHeaders(['User-Agent' => 'LaravelApp/1.0'])
                ->timeout(10)
                ->get('https://nominatim.openstreetmap.org/search', [
                    'q' => "{$clean} university",
                    'format' => 'json',
                    'limit' => 1,
                    'addressdetails' => 1,
                ]);

            if ($res->ok() && count($res->json()) > 0) {
                $addr = $res->json()[0]['address'] ?? [];
                return $addr['city'] ?? $addr['town'] ?? $addr['village'] ?? $addr['municipality'] ?? $addr['county'] ?? null;
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
