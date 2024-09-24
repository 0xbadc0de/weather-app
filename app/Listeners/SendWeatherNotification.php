<?php

namespace App\Listeners;

use App\Events\WeatherFetched;
use App\Models\User;
use App\Notifications\WeatherConditionReached;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWeatherNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(WeatherFetched $event): void
    {
        // This can be done in different way (notification settings), since index here not very efficient
        // Also this can be done in Service
        $users = User::select('users.*')
            ->join('weather_city_watchlist', 'weather_city_watchlist.user_id', '=', 'users.id')
            ->where('weather_city_watchlist.name', $event->weatherSummary->city)
            ->where(function ($q) use ($event) {
                $q->whereRaw('(weather_city_watchlist.precipitation_threshold IS NULL OR weather_city_watchlist.precipitation_threshold >= ?)', $event->weatherSummary->precipitation)
                    ->orWhereRaw('(weather_city_watchlist.uv_threshold IS NULL OR weather_city_watchlist.uv_threshold >= ?)', $event->weatherSummary->uvIndex);
            })
            ->whereRaw('users.notifications_enabled = ? AND (users.notifications_paused IS NULL OR users.notifications_paused < CURRENT_TIMESTAMP)', [true])
            ->get();

        /** @var \App\Models\User $user */
        foreach ($users as $user) {
            $user->notify(new WeatherConditionReached($event->weatherSummary));
        }
    }
}
