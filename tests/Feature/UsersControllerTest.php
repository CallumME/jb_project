<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function test_get_all_users(): void
    {
        $response = $this->get('/api/users');

        $response->assertStatus(405);
    }

    public function register_user(): void
    {
        $response = $this->post('/api/register', [
            'name' => 'John Doe',
            'email' => 'test@gmail.com',
            'password' => 'password'
        ]);

        $response->assertStatus(201);

        $response->assertJson([
            'message' => 'User registered successfully.'
        ]);

        $response->assertDatabaseHas('users', [
            'email' => 'test@gmail.com'
        ]);
    }
}
