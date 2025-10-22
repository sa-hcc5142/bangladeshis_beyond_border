<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'description' => 'Administrator with full access to CRUD operations and comment approval',
            ],
            [
                'name' => 'author',
                'description' => 'Can post blogs and reply to user comments in blog section',
            ],
            [
                'name' => 'user',
                'description' => 'Can comment on countries and blogs, no CRUD permissions',
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }

        $this->command->info('✓ Roles seeded successfully!');
    }
}
