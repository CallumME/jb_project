<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('services.weather.api_key');
        $this->apiUrl = config('services.weather.api_url');
    }

    public function getWeatherByCity($city)
    {
        $apiKey = env('WEATHER_API_KEY');
        $apiURL = env('WEATHER_API_URL');



        $cacheKey = 'weather-' . $city;
        $weatherData = cache($cacheKey);

        if ($weatherData) {
            return $weatherData;
        }

        // dd($apiKey);
        $response = Http::get($apiURL, [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric',
        ]);

        if ($response->successful()) {

            cache([$cacheKey => $response->json()], now()->addMinutes(10));

            return $response->json();
        }

        return null;
    }
}