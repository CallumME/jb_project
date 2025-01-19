<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use App\Models\User;

class WeatherControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_weather_api_with_mock_data()
    {

        $user = User::factory()->create();

        // Prepare mock weather API response
        $mockData = [
            'coord' => ['lon' => 139, 'lat' => 35],
            'weather' => [
                [
                    'id' => 801,
                    'main' => 'Clouds',
                    'description' => 'few clouds',
                    'icon' => '02d',
                ],
            ],
            'main' => [
                'temp' => 289.92,
                'feels_like' => 287.43,
                'temp_min' => 288.45,
                'temp_max' => 290.77,
                'pressure' => 1013,
                'humidity' => 81,
            ],
            'wind' => [
                'speed' => 1.5,
                'deg' => 350,
            ],
            'sys' => [
                'country' => 'AU',
            ],
            'name' => 'Perth',
        ];

        // Mock the weather API call
        Http::fake([
            'api.openweathermap.org/data/2.5/weather*' => Http::response($mockData, 200),
        ]);

        // Make a request to your weather route (e.g., /weather) which calls the weather API
        $response = $this->actingAs($user)->get('/api/weather');

        // Assert that the response status is OK (200)
        $response->assertStatus(200);

        // Assert that the response contains expected data
        $response->assertJson([
            'city' => 'Perth',
            'description' => 'few clouds',
            'temperature' => 289.92,
        ]);
    }
}