<?php

namespace App\Console\Commands;

use App\Events\WeatherFetched;
use App\Models\User;
use App\Models\WeatherCityWatchlist;
use App\Services\Weather\DTO\WeatherFetchDTO;
use App\Services\Weather\WeatherProvider;
use App\Services\Weather\WeatherProviderFactory;
use Illuminate\Console\Command;

class FetchWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches weather';

    /**
     * Execute the console command.
     */
    public function handle(WeatherProvider $weatherProvider): int
    {
        $this->info('Starting weather fetch');

        // Fetch cities to fetch
        $cities = WeatherCityWatchlist::all();
        if ($cities->isEmpty()) {
            $this->line('No cities to fetch weather from');
            return self::SUCCESS;
        }

        $cityNames = $cities->pluck('name');

        foreach ($cityNames as $cityName) {
            /*
             * Only Pro+ and Business subscriptions supports "bulk" query parameter.
             * https://www.weatherapi.com/docs/#intro-bulk
             */
            $weatherSummary = $weatherProvider->fetchWeather(new WeatherFetchDTO($cityName));
            WeatherFetched::dispatch($weatherSummary);
        }

        return self::SUCCESS;
    }
}
