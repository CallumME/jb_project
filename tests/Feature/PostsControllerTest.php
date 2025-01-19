<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;

class PostsControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Request to get all posts
     */

    public function test_get_all_posts(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/api/posts');

        $response->assertStatus(200);
    }

    /**
     * Request to create a specific post
     */

    public function test_create_post(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/api/posts', [
            'title' => 'Test Post',
            'content' => 'This is a test post',
            'user_id' => $user->id,
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'title' => 'Test Post',
            'content' => 'This is a test post',
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
            'content' => 'This is a test post',
            'user_id' => $user->id,
        ]);
    }

    /**
     * Test creating a post without authentication.
     *
     * @return void
     */
    public function test_create_post_without_authentication()
    {
        // Attempt to create a post without authentication
        $response = $this->post('/api/posts', [
            'title' => 'Unauthorized Post Title',
            'content' => 'This should not be allowed.',
        ]);

        // Check that the user is redirected to the login page
        $response->assertRedirect('/api/login');
    }


}
