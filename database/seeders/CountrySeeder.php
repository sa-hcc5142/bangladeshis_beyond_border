<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                'name' => 'United States',
                'slug' => 'united-states',
                'description' => 'Study in the Land of Opportunity',
            ],
            [
                'name' => 'United Kingdom',
                'slug' => 'united-kingdom',
                'description' => 'Study at World-Class Historic Universities',
            ],
            [
                'name' => 'Canada',
                'slug' => 'canada',
                'description' => 'Quality Education with Immigration Pathways',
            ],
            [
                'name' => 'Australia',
                'slug' => 'australia',
                'description' => 'World-Class Education Down Under',
            ],
            [
                'name' => 'Germany',
                'slug' => 'germany',
                'description' => 'Tuition-Free Education in Europe',
            ],
            [
                'name' => 'Japan',
                'slug' => 'japan',
                'description' => 'Innovation Meets Tradition',
            ],
        ];

        foreach ($countries as $country) {
            DB::table('countries')->updateOrInsert(
                ['slug' => $country['slug']],
                array_merge($country, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
