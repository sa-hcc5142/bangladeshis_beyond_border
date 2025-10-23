<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use App\Models\Comment;
use App\Models\Country;
use App\Events\CommentApproved;
use App\Events\CommentRejected;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CommentApprovalTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Seed roles
        $this->artisan('db:seed', ['--class' => 'RoleSeeder']);
    }

    /** @test */
    public function authenticated_user_can_submit_comment()
    {
        $user = User::factory()->create();
        $country = Country::create([
            'name' => 'United States',
            'slug' => 'united-states',
            'description' => 'Test country'
        ]);

        $response = $this->actingAs($user)->post(route('comments.store'), [
            'commentable_type' => 'App\Models\Country',
            'commentable_id' => $country->id,
            'question' => 'This is a test question about studying abroad.'
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'question' => 'This is a test question about studying abroad.',
            'status' => 'pending'
        ]);
    }

    /** @test */
    public function guest_cannot_submit_comment()
    {
        $country = Country::create([
            'name' => 'United States',
            'slug' => 'united-states',
            'description' => 'Test country'
        ]);

        $response = $this->post(route('comments.store'), [
            'commentable_type' => 'App\Models\Country',
            'commentable_id' => $country->id,
            'content' => 'Test question'
        ]);

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function banned_user_cannot_submit_comment()
    {
        $user = User::factory()->create();
        $country = Country::create([
            'name' => 'United States',
            'slug' => 'united-states',
            'description' => 'Test country'
        ]);

        // Create 3 warnings to ban user
        for ($i = 0; $i < 3; $i++) {
            $comment = Comment::create([
                'user_id' => $user->id,
                'commentable_type' => 'App\Models\Country',
                'commentable_id' => $country->id,
                'question' => "Warning comment $i",
                'status' => 'pending'
            ]);
            
            $user->warnings()->create([
                'comment_id' => $comment->id,
                'reason' => "Violation $i",
                'section' => 'country'
            ]);
        }

        $this->assertTrue($user->isBanned());

        $response = $this->actingAs($user)->post(route('comments.store'), [
            'commentable_type' => 'App\Models\Country',
            'commentable_id' => $country->id,
            'content' => 'New question'
        ]);

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function admin_can_approve_comment()
    {
        Event::fake();

        $adminRole = Role::where('name', 'admin')->first();
        $admin = User::factory()->create();
        $admin->roles()->attach($adminRole);

        $user = User::factory()->create();
        $country = Country::create([
            'name' => 'United States',
            'slug' => 'united-states',
            'description' => 'Test country'
        ]);

        $comment = Comment::create([
            'user_id' => $user->id,
            'commentable_type' => 'App\Models\Country',
            'commentable_id' => $country->id,
            'question' => 'Test question',
            'status' => 'pending'
        ]);

        $response = $this->actingAs($admin)->post(
            route('admin.comments.approve', $comment),
            ['answer' => 'This is the answer']
        );

        $response->assertRedirect();
        
        $comment->refresh();
        $this->assertEquals('approved', $comment->status);
        $this->assertEquals('This is the answer', $comment->answer);
        $this->assertNotNull($comment->approved_at);

        Event::assertDispatched(CommentApproved::class);
    }

    /** @test */
    public function non_admin_cannot_approve_comment()
    {
        $user = User::factory()->create();
        $country = Country::create([
            'name' => 'United States',
            'slug' => 'united-states',
            'description' => 'Test country'
        ]);

        $comment = Comment::create([
            'user_id' => $user->id,
            'commentable_type' => 'App\Models\Country',
            'commentable_id' => $country->id,
            'question' => 'Test question',
            'status' => 'pending'
        ]);

        $response = $this->actingAs($user)->post(
            route('admin.comments.approve', $comment)
        );

        $response->assertStatus(403);
    }

    /** @test */
    public function admin_can_reject_comment_and_issue_warning()
    {
        // Don't fake events for this test - we need the listener to run
        
        $adminRole = Role::where('name', 'admin')->first();
        $admin = User::factory()->create();
        $admin->roles()->attach($adminRole);

        $user = User::factory()->create();
        $country = Country::create([
            'name' => 'United States',
            'slug' => 'united-states',
            'description' => 'Test country'
        ]);

        $comment = Comment::create([
            'user_id' => $user->id,
            'commentable_type' => 'App\Models\Country',
            'commentable_id' => $country->id,
            'question' => 'Inappropriate content',
            'status' => 'pending'
        ]);

        $response = $this->actingAs($admin)->post(
            route('admin.comments.reject', $comment),
            ['reason' => 'Violates community guidelines']
        );

        $response->assertRedirect();
        
        $comment->refresh();
        $this->assertEquals('rejected', $comment->status);
        $this->assertNotNull($comment->rejection_reason);

        // Check warning was created (listener should have run)
        $this->assertDatabaseHas('comment_warnings', [
            'user_id' => $user->id,
            'comment_id' => $comment->id,
            'reason' => 'Violates community guidelines'
        ]);
    }

    /** @test */
    public function user_is_banned_after_three_warnings()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $admin = User::factory()->create();
        $admin->roles()->attach($adminRole);

        $user = User::factory()->create();
        $country = Country::create([
            'name' => 'United States',
            'slug' => 'united-states',
            'description' => 'Test country'
        ]);

        $this->assertFalse($user->isBanned());

        // Create and reject 3 comments
        for ($i = 1; $i <= 3; $i++) {
            $comment = Comment::create([
                'user_id' => $user->id,
                'commentable_type' => 'App\Models\Country',
                'commentable_id' => $country->id,
                'question' => "Violation comment $i",
                'status' => 'pending'
            ]);

            $this->actingAs($admin)->post(
                route('admin.comments.reject', $comment),
                ['reason' => "Violation reason $i"]
            );
        }

        $user->refresh();
        $this->assertTrue($user->isBanned());
        $this->assertEquals(3, $user->warningCount());
    }

    /** @test */
    public function user_can_view_their_own_comments()
    {
        $user = User::factory()->create();
        $country = Country::create([
            'name' => 'United States',
            'slug' => 'united-states',
            'description' => 'Test country'
        ]);

        Comment::create([
            'user_id' => $user->id,
            'commentable_type' => 'App\Models\Country',
            'commentable_id' => $country->id,
            'question' => 'My question',
            'status' => 'pending'
        ]);

        $response = $this->actingAs($user)->get(route('comments.my'));

        $response->assertStatus(200);
        $response->assertSee('My question');
    }
}
