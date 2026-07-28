<?php

namespace App\Listeners;

use App\Events\EmailCreated;
use App\Mail\EmailConfirmed;
use Illuminate\Support\Facades\Mail;

class SendContactEmail
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(EmailCreated $event): void
    {
        $email = $event->email;

        Mail::to($email->email)->send(new EmailConfirmed(
            name: $email->name,
            email: $email->email,
            phone: $email->phone,
            topic: $email->subject,
            content: $email->message,
        ));
    }
}
