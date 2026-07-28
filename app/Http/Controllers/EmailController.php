<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Http\Requests\QuoteFormRequest;
use App\Services\ContactEmailStoreService;
use App\Services\MailReCaptchaService;
use App\Services\QuoteEmailStoreService;

class EmailController extends Controller
{
    public function __construct(
        private ContactEmailStoreService $contactService,
        private QuoteEmailStoreService $quoteService,
        private MailReCaptchaService $mailReCaptchaService,
    ) {}

    public function contact(ContactFormRequest $request)
    {
        $captchaIsValid = $this->mailReCaptchaService->__invoke(recaptchaResponse: $request->string('token'), ip: request()->ip());

        if ($captchaIsValid) {
            $saved = $this->contactService->__invoke(
                name: $request->string('name'),
                subject: $request->string('subject'),
                phone: $request->string('phone'),
                email: $request->string('email'),
                message: $request->string('message'),
            );
            if ($saved) {
                return response()->json(
                    [
                        'state' => true,
                        'message' => $this->messages('success'),
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'state' => false,
                        'message' => $this->messages('error'),
                    ],
                    400
                );
            }
        }

        return response()->json(
            [
                'state' => false,
                'message' => $this->messages('captcha')
            ],
            400
        );
    }

    public function sendQuotation(QuoteFormRequest $request)
    {
        $captchaIsValid = $this->mailReCaptchaService->__invoke(recaptchaResponse: $request->string('token'), ip: request()->ip());

        if ($captchaIsValid) {
            $saved = $this->quoteService->__invoke(
                name: $request->string('name'),
                email: $request->string('email'),
                phone: $request->string('phone'),
                message: $request->string('message'),
                products: $request->array('products'),
            );
            if ($saved) {
                return response()->json(
                    [
                        'state' => true,
                        'message' => $this->messages('success'),
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'state' => false,
                        'message' => $this->messages('error'),
                    ],
                    400
                );
            }
        }

        return response()->json(
            [
                'state' => false,
                'message' => $this->messages('captcha')
            ],
            400
        );
    }

    private function messages(string $action)
    {
        $messages = [
            'success' => 'Su mensaje ha sido recibido correctamente. Muchas gracias.',
            'error'   => 'Ocurrió un error inesperado. Por favor intente nuevamente más tarde.',
            'captcha' => 'Ocurrió un error. Probablemente no es una persona real.',
        ];

        return $messages[$action] ?? $messages['error'];
    }
}
