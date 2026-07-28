<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class QuotationConfirmedEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $phone,
        public array  $products,
        public string $content,
        public string $currency
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Correo electrónico de cotización recibido',
            from: new Address(config('settings.email'), config('settings.site_name')),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $this->products = collect($this->products)
            ->map(function ($product) {

                if (!is_array($product)) {
                    return [
                        'name' => null,
                        'url' => null,
                        'quantity' => null,
                        'base64Image' => null,
                    ];
                }

                $imagePath = isset($product['image'])
                    ? public_path('storage/' . $product['image'])
                    : null;

                $product['base64Image'] = ($imagePath && file_exists($imagePath))
                    ? base64_encode(file_get_contents($imagePath))
                    : null;

                return $product;
            })
            ->values()
            ->all();

        return new Content(
            markdown: 'emails.quotation-confirmed',
            with: [
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'content' => $this->content,
                'products' => $this->products,
                'currency' => $this->currency
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
