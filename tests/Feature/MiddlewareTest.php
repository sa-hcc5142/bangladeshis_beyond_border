<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Seed roles
        $this->artisan('db:seed', ['--class' => 'RoleSeeder']);
    }

    /** @test */
    public function admin_middleware_allows_admin_users()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $admin = User::factory()->create();
        $admin->roles()->attach($adminRole);

        $response = $this->actingAs($admin)->get(route('admin.universities.index'));

        $response->assertStatus(200);
    }

    /** @test */
    public function admin_middleware_blocks_regular_users()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.universities.index'));

        $response->assertStatus(403);
    }

    /** @test */
    public function admin_middleware_blocks_guests()
    {
        $response = $this->get(route('admin.universities.index'));

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function author_middleware_allows_authors()
    {
        $authorRole = Role::where('name', 'author')->first();
        $author = User::factory()->create();
        $author->roles()->attach($authorRole);

        // Test that author can access author-only routes
        $this->assertTrue($author->hasRole('author'));
        $this->assertFalse($author->hasRole('admin'));
    }

    /** @test */
    public function author_middleware_allows_admins()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $admin = User::factory()->create();
        $admin->roles()->attach($adminRole);

        // Admins should have access to author routes
        $this->assertTrue($admin->hasRole('admin'));
    }

    /** @test */
    public function banned_middleware_blocks_banned_users()
    {
        $user = User::factory()->create();
        
        // Create a country for the comment
        $country = \App\Models\Country::create([
            'name' => 'Test Country',
            'slug' => 'test-country',
            'description' => 'Test'
        ]);
        
        // Create a comment first for warnings
        $comment = \App\Models\Comment::create([
            'user_id' => $user->id,
            'commentable_type' => 'App\Models\Country',
            'commentable_id' => $country->id,
            'question' => 'Test question for warnings',
            'status' => 'pending'
        ]);
        
        // Create 3 warnings to ban user
        for ($i = 0; $i < 3; $i++) {
            $user->warnings()->create([
                'comment_id' => $comment->id,
                'reason' => "Test violation $i",
                'section' => 'country'
            ]);
        }

        $this->assertTrue($user->isBanned());

        $response = $this->actingAs($user)->get(route('comments.my'));

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function banned_middleware_allows_non_banned_users()
    {
        $user = User::factory()->create();

        $this->assertFalse($user->isBanned());

        $response = $this->actingAs($user)->get(route('comments.my'));

        $response->assertStatus(200);
    }

    /** @test */
    public function user_roles_can_be_checked()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $authorRole = Role::where('name', 'author')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::factory()->create();
        $admin->roles()->attach($adminRole);

        $author = User::factory()->create();
        $author->roles()->attach($authorRole);

        $regularUser = User::factory()->create();
        $regularUser->roles()->attach($userRole);

        $this->assertTrue($admin->hasRole('admin'));
        $this->assertTrue($admin->isAdmin());
        
        $this->assertTrue($author->hasRole('author'));
        $this->assertTrue($author->isAuthor());
        
        $this->assertTrue($regularUser->hasRole('user'));
        $this->assertFalse($regularUser->isAdmin());
        $this->assertFalse($regularUser->isAuthor());
    }
}
