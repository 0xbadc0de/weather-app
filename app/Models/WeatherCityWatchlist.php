<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeatherCityWatchlist extends Model
{
    use HasFactory;

    protected $table = 'weather_city_watchlist';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
