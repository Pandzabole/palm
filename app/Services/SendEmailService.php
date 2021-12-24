<?php

namespace App\Services;

use App\Notifications\SendClassReservationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailService implements ShouldQueue
{
    /**
     * @param $reservation
     * @param $language
     */
    public function sendEmail($reservation, $language)
    {
        $reservation->notify(
            new SendClassReservationEmail($language)
        );
    }
}
