<?php

namespace App\Listeners;

use App\Events\EmailCreated;
use App\Mail\EmailReceived;
use Illuminate\Support\Facades\Mail;

class SendContactReceivedEmail
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
        Mail::to(config('settings.email'))->send(new EmailReceived(
            name: $email->name,
            email: $email->email,
            phone: $email->phone,
            topic: $email->subject,
            content: $email->message,
        ));
    }
}
