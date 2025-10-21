<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\University;
use App\Models\UniversityRanking;
use App\Models\Subject;
use App\Models\SubjectRanking;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use ZipArchive;

class QSCsvUniversitySeeder extends Seeder
{
    private $currentYear = 2025;
    
    public function run(): void
    {
        $this->command->info('🎓 Starting QS Rankings CSV Import...');
        
        // Create subjects first
        $this->command->info('📚 Creating subjects...');
        $this->createSubjects();
        
        // Import universities from CSV
        $this->command->info('🏛️  Importing universities from CSV...');
        $this->importUniversitiesFromCsv();
        
        $this->command->info('✅ Import complete!');
    }

    private function createSubjects()
    {
        // Skip if subjects already exist
        if (Subject::count() > 0) {
            $this->command->info('   Subjects already exist, skipping...');
            return;
        }

        $subjects = [
            // Broad Subject Areas (5)
            ['name' => 'Arts & Humanities', 'slug' => 'arts-humanities', 'icon' => '🎨', 'category' => 'broad'],
            ['name' => 'Engineering & Technology', 'slug' => 'engineering-technology', 'icon' => '⚙️', 'category' => 'broad'],
            ['name' => 'Life Sciences & Medicine', 'slug' => 'life-sciences-medicine', 'icon' => '🏥', 'category' => 'broad'],
            ['name' => 'Natural Sciences', 'slug' => 'natural-sciences', 'icon' => '🔬', 'category' => 'broad'],
            ['name' => 'Social Sciences & Management', 'slug' => 'social-sciences-management', 'icon' => '📊', 'category' => 'broad'],
            
            // Arts & Humanities Subjects (11)
            ['name' => 'Archaeology', 'slug' => 'archaeology', 'icon' => '🏛️', 'category' => 'specific'],
            ['name' => 'Architecture & Built Environment', 'slug' => 'architecture', 'icon' => '🏗️', 'category' => 'specific'],
            ['name' => 'Art & Design', 'slug' => 'art-design', 'icon' => '🎨', 'category' => 'specific'],
            ['name' => 'Classics & Ancient History', 'slug' => 'classics-ancient-history', 'icon' => '📜', 'category' => 'specific'],
            ['name' => 'English Language & Literature', 'slug' => 'english-language-literature', 'icon' => '📚', 'category' => 'specific'],
            ['name' => 'History', 'slug' => 'history', 'icon' => '📖', 'category' => 'specific'],
            ['name' => 'Linguistics', 'slug' => 'linguistics', 'icon' => '🗣️', 'category' => 'specific'],
            ['name' => 'Modern Languages', 'slug' => 'modern-languages', 'icon' => '🌍', 'category' => 'specific'],
            ['name' => 'Performing Arts', 'slug' => 'performing-arts', 'icon' => '🎭', 'category' => 'specific'],
            ['name' => 'Philosophy', 'slug' => 'philosophy', 'icon' => '🤔', 'category' => 'specific'],
            ['name' => 'Theology, Divinity & Religious Studies', 'slug' => 'theology', 'icon' => '✝️', 'category' => 'specific'],
            
            // Engineering & Technology Subjects (7)
            ['name' => 'Computer Science & Information Systems', 'slug' => 'computer-science', 'icon' => '💻', 'category' => 'specific'],
            ['name' => 'Chemical Engineering', 'slug' => 'chemical-engineering', 'icon' => '⚗️', 'category' => 'specific'],
            ['name' => 'Civil & Structural Engineering', 'slug' => 'civil-engineering', 'icon' => '🌉', 'category' => 'specific'],
            ['name' => 'Electrical & Electronic Engineering', 'slug' => 'electrical-engineering', 'icon' => '⚡', 'category' => 'specific'],
            ['name' => 'Mechanical, Aeronautical & Manufacturing Engineering', 'slug' => 'mechanical-engineering', 'icon' => '🔧', 'category' => 'specific'],
            ['name' => 'Mining & Mineral Engineering', 'slug' => 'mining-engineering', 'icon' => '⛏️', 'category' => 'specific'],
            ['name' => 'Petroleum Engineering', 'slug' => 'petroleum-engineering', 'icon' => '🛢️', 'category' => 'specific'],
            
            // Life Sciences & Medicine Subjects (9)
            ['name' => 'Agriculture & Forestry', 'slug' => 'agriculture-forestry', 'icon' => '🌾', 'category' => 'specific'],
            ['name' => 'Anatomy & Physiology', 'slug' => 'anatomy-physiology', 'icon' => '🫀', 'category' => 'specific'],
            ['name' => 'Biological Sciences', 'slug' => 'biological-sciences', 'icon' => '🧬', 'category' => 'specific'],
            ['name' => 'Dentistry', 'slug' => 'dentistry', 'icon' => '🦷', 'category' => 'specific'],
            ['name' => 'Medicine', 'slug' => 'medicine', 'icon' => '🏥', 'category' => 'specific'],
            ['name' => 'Nursing', 'slug' => 'nursing', 'icon' => '👨‍⚕️', 'category' => 'specific'],
            ['name' => 'Pharmacy & Pharmacology', 'slug' => 'pharmacy', 'icon' => '💊', 'category' => 'specific'],
            ['name' => 'Psychology', 'slug' => 'psychology', 'icon' => '🧠', 'category' => 'specific'],
            ['name' => 'Veterinary Science', 'slug' => 'veterinary-science', 'icon' => '🐕', 'category' => 'specific'],
            
            // Natural Sciences Subjects (9)
            ['name' => 'Chemistry', 'slug' => 'chemistry', 'icon' => '🧪', 'category' => 'specific'],
            ['name' => 'Earth & Marine Sciences', 'slug' => 'earth-marine-sciences', 'icon' => '🌊', 'category' => 'specific'],
            ['name' => 'Environmental Sciences', 'slug' => 'environmental-sciences', 'icon' => '🌿', 'category' => 'specific'],
            ['name' => 'Geography', 'slug' => 'geography', 'icon' => '🗺️', 'category' => 'specific'],
            ['name' => 'Geology', 'slug' => 'geology', 'icon' => '🪨', 'category' => 'specific'],
            ['name' => 'Geophysics', 'slug' => 'geophysics', 'icon' => '🌋', 'category' => 'specific'],
            ['name' => 'Materials Science', 'slug' => 'materials-science', 'icon' => '�', 'category' => 'specific'],
            ['name' => 'Mathematics', 'slug' => 'mathematics', 'icon' => '➗', 'category' => 'specific'],
            ['name' => 'Physics & Astronomy', 'slug' => 'physics-astronomy', 'icon' => '🔭', 'category' => 'specific'],
            
            // Social Sciences & Management Subjects (15)
            ['name' => 'Accounting & Finance', 'slug' => 'accounting-finance', 'icon' => '💰', 'category' => 'specific'],
            ['name' => 'Anthropology', 'slug' => 'anthropology', 'icon' => '🗿', 'category' => 'specific'],
            ['name' => 'Business & Management Studies', 'slug' => 'business-management', 'icon' => '📊', 'category' => 'specific'],
            ['name' => 'Communication & Media Studies', 'slug' => 'communication-media', 'icon' => '📡', 'category' => 'specific'],
            ['name' => 'Development Studies', 'slug' => 'development-studies', 'icon' => '🌱', 'category' => 'specific'],
            ['name' => 'Economics & Econometrics', 'slug' => 'economics', 'icon' => '📈', 'category' => 'specific'],
            ['name' => 'Education & Training', 'slug' => 'education', 'icon' => '🎓', 'category' => 'specific'],
            ['name' => 'Hospitality & Tourism Management', 'slug' => 'hospitality-tourism', 'icon' => '✈️', 'category' => 'specific'],
            ['name' => 'Law & Legal Studies', 'slug' => 'law', 'icon' => '⚖️', 'category' => 'specific'],
            ['name' => 'Library & Information Management', 'slug' => 'library-information', 'icon' => '📚', 'category' => 'specific'],
            ['name' => 'Politics & International Studies', 'slug' => 'politics', 'icon' => '🏛️', 'category' => 'specific'],
            ['name' => 'Social Policy & Administration', 'slug' => 'social-policy', 'icon' => '📋', 'category' => 'specific'],
            ['name' => 'Sociology', 'slug' => 'sociology', 'icon' => '👥', 'category' => 'specific'],
            ['name' => 'Sports-Related Subjects', 'slug' => 'sports-science', 'icon' => '⚽', 'category' => 'specific'],
            ['name' => 'Statistics & Operational Research', 'slug' => 'statistics', 'icon' => '📊', 'category' => 'specific'],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
        
        $this->command->info('   Created ' . count($subjects) . ' subjects');
    }

    private function importUniversitiesFromCsv()
    {
        // Try CSV first, then Excel
        $csvPath = database_path('seeders/data/qs_rankings_2025.csv');
        $xlsxPath = database_path('seeders/data/qs_rankings_2025.csv.xlsx');
        
        $csvData = [];
        
        // Check if CSV exists
        if (File::exists($csvPath)) {
            $this->command->info("   Reading CSV from: $csvPath");
            $csvData = $this->readCsvFile($csvPath);
        }
        // Check if Excel exists
        elseif (File::exists($xlsxPath)) {
            $this->command->info("   Reading Excel from: $xlsxPath");
            $csvData = $this->readExcelFile($xlsxPath);
        }
        else {
            $this->command->error("❌ No data file found!");
            $this->command->error("   Looked for:");
            $this->command->error("   - $csvPath");
            $this->command->error("   - $xlsxPath");
            return;
        }
        
        if (empty($csvData)) {
            $this->command->error("❌ File is empty or could not be parsed");
            return;
        }

        // Limit to top 600 universities only
        $csvData = array_slice($csvData, 0, 600);
        
        $this->command->info("   Found " . count($csvData) . " universities (limited to top 600)");
        
        // Disable query logging for better performance
        DB::connection()->disableQueryLog();
        
        // Create progress bar
        $progressBar = $this->command->getOutput()->createProgressBar(count($csvData));
        $progressBar->start();
        
        $subjects = Subject::all();
        $usedSlugs = [];
        $imported = 0;
        $skipped = 0;
        
        foreach ($csvData as $index => $row) {
            try {
                // Skip if essential data is missing
                if (empty($row['university_name']) || empty($row['rank'])) {
                    $skipped++;
                    $progressBar->advance();
                    continue;
                }
                
                // Clean and prepare data
                $universityName = trim($row['university_name']);
                $rank = $this->parseRank($row['rank']);
                
                // Generate unique slug
                $baseSlug = Str::slug($universityName);
                $slug = $baseSlug;
                $counter = 1;
                
                while (in_array($slug, $usedSlugs)) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }
                
                $usedSlugs[] = $slug;
                
                // Determine region from country
                $country = $row['country'] ?? 'Unknown';
                $region = $this->determineRegion($country);
                
                // Create University
                $university = University::create([
                    'name' => $universityName,
                    'slug' => $slug,
                    'country' => $country,
                    'city' => $row['city'] ?? 'Unknown',
                    'region' => $region,
                    'description' => $row['description'] ?? 'A leading university known for excellence in research and education.',
                    'website' => $row['website'] ?? null,
                    'is_active' => true,
                ]);

                // Create Overall Ranking
                UniversityRanking::create([
                    'university_id' => $university->id,
                    'year' => $this->currentYear,
                    'rank' => $rank,
                    'overall_score' => $this->parseFloat($row['overall_score'] ?? $row['score'] ?? 0),
                    'academic_reputation' => $this->parseFloat($row['academic_reputation'] ?? $row['academic'] ?? 0),
                    'citations_per_faculty' => $this->parseFloat($row['citations_per_faculty'] ?? $row['citations'] ?? 0),
                    'employer_reputation' => $this->parseFloat($row['employer_reputation'] ?? rand(60, 95)),
                    'faculty_student_ratio' => $this->parseFloat($row['faculty_student_ratio'] ?? rand(50, 90)),
                    'international_faculty' => $this->parseFloat($row['international_faculty'] ?? rand(40, 90)),
                    'international_students' => $this->parseFloat($row['international_students'] ?? rand(30, 85)),
                    'research_discovery' => $this->parseFloat($row['research_discovery'] ?? rand(70, 95)),
                    'learning_experience' => $this->parseFloat($row['learning_experience'] ?? rand(65, 90)),
                    'employability' => $this->parseFloat($row['employability'] ?? rand(60, 90)),
                    'global_engagement' => $this->parseFloat($row['global_engagement'] ?? rand(55, 90)),
                    'sustainability' => $this->parseFloat($row['sustainability'] ?? rand(50, 85)),
                ]);

                // Skip subject rankings for now - speeds up seeding significantly
                // You can add them later with a separate seeder if needed
                
                $imported++;
                
            } catch (\Exception $e) {
                $this->command->error("\n   Error importing row " . ($index + 1) . ": " . $e->getMessage());
                $skipped++;
            }
            
            $progressBar->advance();
        }
        
        $progressBar->finish();
        $this->command->newLine();
        $this->command->info("   ✅ Imported: $imported universities");
        
        if ($skipped > 0) {
            $this->command->warn("   ⚠️  Skipped: $skipped rows (missing data or errors)");
        }
    }

    private function readCsvFile($path)
    {
        $data = [];
        
        if (($handle = fopen($path, "r")) !== false) {
            $lineNumber = 0;
            $header = [];
            
            while (($row = fgetcsv($handle, 0, ",")) !== false) {
                $lineNumber++;
                
                // Skip empty rows
                if (empty(array_filter($row))) {
                    continue;
                }
                
                // The QS format has headers on line 3 (after title and sub-headers)
                // Look for the row that contains "Index" and "Rank" and "Name"
                if (empty($header)) {
                    // Check if this row contains key column identifiers
                    if (in_array('Index', $row) || in_array('Rank', $row) || in_array('Name', $row)) {
                        // This is the header row
                        $header = array_map(function($col) {
                            $col = trim($col);
                            // Map common QS column names to our expected format
                            $mapping = [
                                'Name' => 'university_name',
                                'Institution' => 'university_name',
                                'Country/Territory' => 'country',
                                'Location' => 'location',
                                'Region' => 'region',
                                'Overall SCORE' => 'overall_score',
                                'AR SCORE' => 'academic_reputation',
                                'ER SCORE' => 'employer_reputation',
                                'CPF SCORE' => 'citations_per_faculty',
                                'FSR SCORE' => 'faculty_student_ratio',
                                'IFR SCORE' => 'international_faculty',
                                'ISR SCORE' => 'international_students',
                                '2026' => 'rank',
                                'Rank' => 'rank',
                            ];
                            
                            if (isset($mapping[$col])) {
                                return $mapping[$col];
                            }
                            
                            // Otherwise normalize the column name
                            return strtolower(str_replace([' ', '-', '(', ')', '/', '.'], '_', $col));
                        }, $row);
                        continue;
                    }
                    continue;
                }
                
                // Data rows - combine with header
                if (count($row) === count($header)) {
                    $rowData = array_combine($header, $row);
                    
                    // Skip rows without essential data
                    if (!empty($rowData['university_name']) && !empty($rowData['rank'])) {
                        // Extract city from location if needed
                        if (isset($rowData['location']) && !isset($rowData['city'])) {
                            $rowData['city'] = $rowData['location'];
                        }
                        
                        $data[] = $rowData;
                    }
                }
            }
            
            fclose($handle);
        }
        
        return $data;
    }

    private function parseRank($rank)
    {
        // Handle rank ranges like "501-510" - take the first number
        if (is_string($rank) && strpos($rank, '-') !== false) {
            $parts = explode('-', $rank);
            return intval($parts[0]);
        }
        
        // Handle rank with "=" like "=15"
        $rank = str_replace('=', '', $rank);
        
        return intval($rank);
    }

    private function parseFloat($value)
    {
        if (is_numeric($value)) {
            return floatval($value);
        }
        
        // Remove any non-numeric characters except . and -
        $cleaned = preg_replace('/[^0-9.-]/', '', $value);
        
        return floatval($cleaned ?: 0);
    }

    private function determineRegion($country)
    {
        $regionMap = [
            // North America
            'United States' => 'North America',
            'USA' => 'North America',
            'Canada' => 'North America',
            'Mexico' => 'North America',
            
            // Europe
            'United Kingdom' => 'Europe',
            'UK' => 'Europe',
            'England' => 'Europe',
            'Scotland' => 'Europe',
            'Wales' => 'Europe',
            'Germany' => 'Europe',
            'France' => 'Europe',
            'Switzerland' => 'Europe',
            'Netherlands' => 'Europe',
            'Sweden' => 'Europe',
            'Denmark' => 'Europe',
            'Norway' => 'Europe',
            'Finland' => 'Europe',
            'Belgium' => 'Europe',
            'Austria' => 'Europe',
            'Italy' => 'Europe',
            'Spain' => 'Europe',
            'Portugal' => 'Europe',
            'Ireland' => 'Europe',
            'Poland' => 'Europe',
            'Czech Republic' => 'Europe',
            'Greece' => 'Europe',
            'Russia' => 'Europe',
            'Turkey' => 'Europe',
            
            // Asia
            'China' => 'Asia',
            'Japan' => 'Asia',
            'South Korea' => 'Asia',
            'Korea' => 'Asia',
            'Singapore' => 'Asia',
            'Hong Kong' => 'Asia',
            'Hong Kong SAR' => 'Asia',
            'Taiwan' => 'Asia',
            'India' => 'Asia',
            'Malaysia' => 'Asia',
            'Thailand' => 'Asia',
            'Indonesia' => 'Asia',
            'Philippines' => 'Asia',
            'Vietnam' => 'Asia',
            'Pakistan' => 'Asia',
            'Bangladesh' => 'Asia',
            'Israel' => 'Asia',
            'United Arab Emirates' => 'Asia',
            'UAE' => 'Asia',
            'Saudi Arabia' => 'Asia',
            
            // Oceania
            'Australia' => 'Oceania',
            'New Zealand' => 'Oceania',
            
            // Latin America
            'Brazil' => 'Latin America',
            'Argentina' => 'Latin America',
            'Chile' => 'Latin America',
            'Colombia' => 'Latin America',
            'Peru' => 'Latin America',
            
            // Africa
            'South Africa' => 'Africa',
            'Egypt' => 'Africa',
            'Kenya' => 'Africa',
            'Nigeria' => 'Africa',
            'Morocco' => 'Africa',
        ];
        
        return $regionMap[$country] ?? 'Other';
    }

    private function readExcelFile($path)
    {
        $this->command->info("   📊 Reading Excel file using simple XML extraction...");
        
        $data = [];
        
        try {
            // Excel files are ZIP archives containing XML
            $zip = new ZipArchive;
            
            if ($zip->open($path) === TRUE) {
                // Read shared strings (contains actual text values)
                $sharedStringsXml = $zip->getFromName('xl/sharedStrings.xml');
                $sharedStrings = [];
                
                if ($sharedStringsXml) {
                    $xml = simplexml_load_string($sharedStringsXml);
                    foreach ($xml->si as $si) {
                        $sharedStrings[] = (string) $si->t;
                    }
                }
                
                // Read the first worksheet
                $sheetXml = $zip->getFromName('xl/worksheets/sheet1.xml');
                
                if ($sheetXml) {
                    $xml = simplexml_load_string($sheetXml);
                    $rows = [];
                    $header = [];
                    $rowIndex = 0;
                    
                    foreach ($xml->sheetData->row as $row) {
                        $rowData = [];
                        $colIndex = 0;
                        
                        foreach ($row->c as $cell) {
                            $value = '';
                            
                            // Check if cell references shared strings
                            if (isset($cell['t']) && (string)$cell['t'] === 's') {
                                $index = (int)(string)$cell->v;
                                $value = isset($sharedStrings[$index]) ? $sharedStrings[$index] : '';
                            } else {
                                $value = (string)$cell->v;
                            }
                            
                            $rowData[] = $value;
                            $colIndex++;
                        }
                        
                        if ($rowIndex === 0) {
                            // First row is header
                            $header = array_map(function($col) {
                                return strtolower(trim(str_replace([' ', '-', '(', ')', '/', '.'], '_', $col)));
                            }, $rowData);
                        } else {
                            // Data rows
                            if (count($rowData) === count($header)) {
                                $rows[] = array_combine($header, $rowData);
                            }
                        }
                        
                        $rowIndex++;
                    }
                    
                    $data = $rows;
                }
                
                $zip->close();
                
                $this->command->info("   ✅ Successfully read " . count($data) . " rows from Excel");
                
            } else {
                $this->command->error("   ❌ Failed to open Excel file as ZIP");
            }
            
        } catch (\Exception $e) {
            $this->command->error("   ❌ Error reading Excel: " . $e->getMessage());
            $this->command->info("   💡 Try converting to CSV manually in Excel:");
            $this->command->info("      File → Save As → CSV UTF-8");
        }
        
        return $data;
    }
}
