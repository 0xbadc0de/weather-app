<?php

namespace App\Services\Weather;

use App\Services\Weather\Enum\WeatherProviderEnum;
use App\Services\Weather\Exceptions\WeatherServiceException;
use App\Services\Weather\Providers\WeatherApi\WeatherApiProvider;

class WeatherProviderFactory
{
    /**
     * Made for service portability. Can be done through Service Container.
     * @throws WeatherServiceException
     */
    public static function build(): WeatherProvider
    {
        // TODO: This can be moved to config
        $currentProvider = WeatherProviderEnum::tryFrom(env('WEATHER_PROVIDER'));

        return match($currentProvider) {
            WeatherProviderEnum::WeatherApi => new WeatherApiProvider(),
            default => throw new WeatherServiceException('Invalid weather provider specified: ' . env('CURRENT_PROVIDER'))
        };
    }
}
