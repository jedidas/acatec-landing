<?php

namespace App\Services;

use App\Models\Email;

final class ContactEmailStoreService
{
    public function __invoke(string $name,  string $subject, string $phone, string $email, string $message)
    {
        return Email::create([
            'name' => $name,
            'subject' => $subject,
            'phone' => $phone,
            'email' => $email,
            'message' => $message,
            'added_on' => now(),
        ]);
    }
}
