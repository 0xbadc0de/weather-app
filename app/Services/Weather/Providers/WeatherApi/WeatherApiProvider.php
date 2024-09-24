<?php

namespace App\Services\Weather\Providers\WeatherApi;

use App\Services\Weather\DTO\WeatherFetchDTO;
use App\Services\Weather\Entity\WeatherSummary;
use App\Services\Weather\WeatherProvider;

class WeatherApiProvider implements WeatherProvider
{
    public function fetchWeather(WeatherFetchDTO $dto): WeatherSummary
    {
        $weatherApiClient = new WeatherApiClient();
        $weatherData = $weatherApiClient->getCurrentWeather($dto->getCity());

        return new WeatherSummary(
            $dto->getCity(),
            $weatherData['current']['precip_mm'],
            $weatherData['current']['uv'],
        );
    }
}
