<?php

namespace App\Listeners;

use App\Events\QuotationCreated;
use App\Mail\QuotationReceivedEmail;
use Illuminate\Support\Facades\Mail;

class SendQuotationReceivedEmail
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(QuotationCreated $event): void
    {
        $quotation = $event->quotation;

        Mail::to(config('settings.email'))
            ->send(new QuotationReceivedEmail(
                id: $quotation->id,
                name: $quotation->name,
                email: $quotation->email,
                phone: $quotation->phone,
                products: $quotation->data_json,
                content: $quotation->message,
                currency: config('services.currency'),
            ));
    }
}
