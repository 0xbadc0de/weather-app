<?php

namespace App\Events;

use App\Services\Weather\Entity\WeatherSummary;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WeatherFetched
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public WeatherSummary $weatherSummary;

    /**
     * Create a new event instance.
     */
    public function __construct(WeatherSummary $weatherSummary)
    {
        $this->weatherSummary = $weatherSummary;
    }
}
