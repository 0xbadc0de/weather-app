<?php

namespace App\Services\Weather\DTO;

readonly class WeatherFetchDTO
{
    public function __construct(
        private string $city,
    ) {}

    public function getCity(): string
    {
        return $this->city;
    }
}
