<?php

namespace App\Services;

use ReCaptcha\ReCaptcha;

final class MailReCaptchaService
{
    public function __invoke(string $recaptchaResponse, string $ip): bool
    {
        $recaptcha = new ReCaptcha(config('services.recaptcha.secret'));    // ← antes: env('reCAPTCHA')
        $resp = $recaptcha
            ->setExpectedHostname(config('services.recaptcha.hostname'))    // ← antes: env('reCAPTCHA_site_hostname')
            ->setScoreThreshold(0.6)
            ->verify($recaptchaResponse, $ip);
        return $resp->isSuccess();
    }
}
