<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;


class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    /**
     * @SWG\Get(
     *     path="/weather",
     *     summary="Get the weather for a city (hardcoded to Perth)",
     *     tags={"Weather"},
     *     @SWG\Response(response=200, description="Successful operation"),
     *     @SWG\Response(response=503, description="Unable to retrieve weather data")
     * )
     */
    public function showWeather()
    {
        $weatherData = $this->weatherService->getWeatherByCity('Perth');

        if ($weatherData) {
            return response()->json([
                'city' => $weatherData['name'],
                'temperature' => $weatherData['main']['temp'],
                'description' => $weatherData['weather'][0]['description'],
            ]);
        }

        return response()->json(['message' => 'Unable to retrieve weather data'], 503);
    }
}