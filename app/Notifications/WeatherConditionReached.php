<?php

namespace App\Notifications;

use App\Services\Weather\Entity\WeatherSummary;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WeatherConditionReached extends Notification implements ShouldQueue
{
    use Queueable;

    private WeatherSummary $weatherSummary;

    /**
     * Create a new notification instance.
     */
    public function __construct(WeatherSummary $weatherSummary)
    {
        $this->weatherSummary = $weatherSummary;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line(sprintf('Weather condition in %s reached', $this->weatherSummary->city))
                    ->line('Precipitation:' . $this->weatherSummary->precipitation)
                    ->line('UV Index: ' . $this->weatherSummary->uvIndex);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'city' => $this->weatherSummary->city,
            'precipitation' => $this->weatherSummary->precipitation,
            'uvIndex' => $this->weatherSummary->uvIndex,
        ];
    }
}
