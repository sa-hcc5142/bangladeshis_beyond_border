<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\University;
use Illuminate\Support\Facades\DB;

class ExportUniversitiesToCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'universities:export-csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export universities with updated city data back to CSV';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Exporting universities to CSV...');
        
        $csvPath = database_path('seeders/data/qs_rankings_2025.csv');
        
        // Get universities with their rankings
        $universities = \App\Models\University::query()
            ->leftJoin('university_rankings', 'universities.id', '=', 'university_rankings.university_id')
            ->select(
                'universities.name',
                'universities.slug',
                'universities.country',
                'universities.city',
                'universities.region',
                'university_rankings.rank',
                'university_rankings.overall_score',
                'university_rankings.year'
            )
            ->orderBy('university_rankings.rank')
            ->get();
        
        // Create temporary file first
        $tempPath = $csvPath . '.tmp';
        
        // Open temporary CSV file for writing
        $file = fopen($tempPath, 'w');
        
        if (!$file) {
            $this->error('Failed to create temporary file. Please close the CSV file if it\'s open.');
            return 1;
        }

        // Write header
        fputcsv($file, ['rank', 'university', 'slug', 'country', 'city', 'region', 'score', 'year']);        // Write data
        foreach ($universities as $university) {
            fputcsv($file, [
                $university->rank ?? '',
                $university->name,
                $university->slug,
                $university->country,
                $university->city ?? 'Unknown',
                $university->region,
                $university->overall_score ?? '',
                $university->year ?? '2025'
            ]);
        }
        
        fclose($file);
        
        // Try to replace the original file
        if (file_exists($csvPath)) {
            $backupPath = $csvPath . '.backup';
            @copy($csvPath, $backupPath);
            
            if (@unlink($csvPath)) {
                rename($tempPath, $csvPath);
                @unlink($backupPath);
                $this->info("\n✅ Successfully exported {$universities->count()} universities to CSV!");
                $this->info("📄 File: {$csvPath}");
            } else {
                $this->warn("\n⚠ Could not replace CSV (file is open). Data saved to:");
                $this->info("📄 {$tempPath}");
                $this->info("\n📌 Close the CSV file and rename the .tmp file manually.");
            }
        } else {
            rename($tempPath, $csvPath);
            $this->info("\n✅ Successfully exported {$universities->count()} universities to CSV!");
            $this->info("📄 File: {$csvPath}");
        }
        
        return 0;
    }
}
