<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed users with different roles
        $this->call([
            UsersTableSeeder::class,
        ]);

        // Import QS World University Rankings (600 universities) from CSV
        $this->call([
            QSCsvUniversitySeeder::class,
        ]);

        // Add quick links for universities
        $this->call([
            UniversityQuickLinksSeeder::class,
        ]);
    }
}
