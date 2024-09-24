<?php

namespace App\Services\Weather;

use App\Services\Weather\DTO\WeatherFetchDTO;
use App\Services\Weather\Entity\WeatherSummary;

interface WeatherProvider
{
    public function fetchWeather(WeatherFetchDTO $dto): WeatherSummary;
}
