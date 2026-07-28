<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Quotation;

final class QuoteEmailStoreService
{
    public function __invoke(
        string $name,
        string $email,
        string $phone,
        string $message,
        array $products,
    ) {
        return Quotation::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message,
            'products' => $products,
            'added_on' => now(),
        ]);
    }
}
