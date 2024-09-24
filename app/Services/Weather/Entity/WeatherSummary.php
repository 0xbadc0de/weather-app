<?php

namespace App\Services\Weather\Entity;

readonly class WeatherSummary
{
    public function __construct(
        public string $city,
        public float $precipitation,
        public float $uvIndex
    ) {}
}
