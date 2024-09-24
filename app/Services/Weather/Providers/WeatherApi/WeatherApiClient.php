<?php

namespace App\Services\Weather\Providers\WeatherApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class WeatherApiClient
{
    protected Client $client;
    protected string $apiKey;
    private const DEFAULT_TIMEOUT = 5.0;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.weatherapi.com/v1/',
            'timeout' => self::DEFAULT_TIMEOUT,
        ]);

        $this->apiKey = config('services.weatherapi.key');
    }

    /**
     * Fetch current weather data
     *
     * @param string $city
     * @return array
     */
    public function getCurrentWeather(string $city): array
    {
        try {
            $response = $this->client->get('current.json', [
                'query' => [
                    'key' => $this->apiKey,
                    'q' => $city,
                ],
            ]);

            /*
            {
                "location": {
                    "name": "Kyiv",
                    "region": "Kyyivs'ka Oblast'",
                    "country": "Ukraine",
                    "lat": 50.43,
                    "lon": 30.52,
                    "tz_id": "Europe/Kiev",
                    "localtime_epoch": 1727188119,
                    "localtime": "2024-09-24 17:28"
                },
                "current": {
                    "last_updated_epoch": 1727187300,
                    "last_updated": "2024-09-24 17:15",
                    "temp_c": 25.0,
                    "temp_f": 77.0,
                    "is_day": 1,
                    "condition": {
                        "text": "Sunny",
                        "icon": "//cdn.weatherapi.com/weather/64x64/day/113.png",
                        "code": 1000
                    },
                    "wind_mph": 8.1,
                    "wind_kph": 13.0,
                    "wind_degree": 130,
                    "wind_dir": "SE",
                    "pressure_mb": 1016.0,
                    "pressure_in": 30.01,
                    "precip_mm": 0.0,
                    "precip_in": 0.0,
                    "humidity": 25,
                    "cloud": 4,
                    "feelslike_c": 24.3,
                    "feelslike_f": 75.7,
                    "windchill_c": 25.0,
                    "windchill_f": 77.0,
                    "heatindex_c": 24.3,
                    "heatindex_f": 75.7,
                    "dewpoint_c": 3.6,
                    "dewpoint_f": 38.4,
                    "vis_km": 10.0,
                    "vis_miles": 6.0,
                    "uv": 7.0,
                    "gust_mph": 13.6,
                    "gust_kph": 21.9
                }
            }
             */

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            throw $e;
        } catch (GuzzleException $e) {
            throw $e;
        }
    }
}
