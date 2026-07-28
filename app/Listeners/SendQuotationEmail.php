<?php

namespace App\Listeners;

use App\Events\QuotationCreated;
use App\Mail\QuotationConfirmedEmail;
use Illuminate\Support\Facades\Mail;

class SendQuotationEmail
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

        Mail::to($quotation->email)
            ->send(new QuotationConfirmedEmail(
                name: $quotation->name,
                email: $quotation->email,
                phone: $quotation->phone,
                products: $quotation->products,
                content: $quotation->message,
                currency: config('services.currency'),
            ));
    }
}
