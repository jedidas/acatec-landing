@php
    $socialNetworks = json_decode(config('settings.social_networks'));
    $telephoneNumbers = json_decode(config('settings.telephone_number'));
    $schedules = json_decode(config('settings.schedule'));
@endphp
<footer class="bg-amber-200">
    <div class="pb-10">
        <iframe class="lazy h-60 w-full"
            data-src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1359.2671335499824!2d-83.97844433183393!3d9.937913290500527!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2scr!4v1771901664464!5m2!1ses-419!2scr"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <section class="container m-auto mb-10 flex w-full flex-col-reverse justify-between gap-6 px-3 lg:flex-row">
        <div class="w-full lg:w-1/2">
            <p class="mb-6 text-sm">
                {{ __('Para conocer más sobre nuestros productos y servicios, escríbanos y con gusto te atenderemos.') }}
            </p>

            @include('partials.contact-form')
        </div>
        <div class="flex flex-col w-full lg:w-1/2">
            <div class="inline-block mb-5 bg-orange p-7 lg:max-w-80 w-full">
                <h4 class="font-bold text-dark-orange mb-3">{{ __('Síguenos en') }}</h4>
                <ul class="flex flex-col gap-3">
                    @foreach ($socialNetworks as $network)
                        <li>
                            <p>
                                <a href="{{ $network->url }}"
                                    class="flex items-center gap-3 text-white underline text-base hover:text-dark-orange"
                                    target="_blank" rel="noopener noreferrer">
                                    <x-icon name="{{ $network->networks }}" class="h-5 w-5" />
                                    {{ $network->name }}
                                </a>
                            </p>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="inline-block bg-orange p-7 lg:max-w-80 w-full">
                <h4 class="font-bold text-dark-orange mb-3">{{ __('Información del contacto') }}</h4>
                <ul class="flex flex-col gap-3">
                    <li>
                        <p>
                            <a href="mailto:{{ config('settings.site_email') }}"
                                class="flex items-center gap-3 text-white underline text-base hover:text-dark-orange"
                                target="_blank" rel="noopener noreferrer">
                                <x-icon name="email" class="h-5 w-5" />
                                {{ config('settings.site_email') }}
                            </a>
                        </p>
                    </li>
                    @foreach ($telephoneNumbers ?? [] as $telephone)
                        <li>
                            <p>
                                @if ($telephone->is_whatsapp)
                                    <a href="https://api.whatsapp.com/send?phone=+506{{ $telephone->number }}"
                                        class="flex items-center gap-3 text-white underline text-base hover:text-dark-orange"
                                        target="_blank" rel="noopener noreferrer">
                                        <x-icon name="whatsapp-lines" class="h-5 w-5" />
                                        {{ $telephone->visible_number }}
                                    </a>
                                @else
                                    <a href="mailto:{{ $telephone->number }}"
                                        class="flex items-center gap-3 text-white underline text-base hover:text-dark-orange"
                                        target="_blank" rel="noopener noreferrer">
                                        <x-icon name="phone" class="h-5 w-5" />
                                        {{ $telephone->visible_number }}
                                    </a>
                                @endif
                            </p>
                        </li>
                    @endforeach
                    <li>
                        <div class="flex relative pl-11">
                            <x-icon name="schedule" class="absolute fill-primary self-center left-0 w-8" />
                            <div>
                                <p class="text-black">
                                    <strong>Horario</strong>
                                </p>
                                @foreach ($schedules as $schedule)
                                    <p class="flex items-center gap-3 text-white text-base">
                                        {{ $schedule->value }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <div class="flex flex-col justify-center gap-2 bg-gray-900 px-5 py-3 sm:flex-row sm:justify-between text-white">
        <div>
            <p class="m-0 p-0 text-center text-sm sm:text-start">
                Designed and developed by
                <a class="font-bold underline text-sm hover:text-orange" href="https://ambideas.com" target="_blank">
                    AMBIDEAS.COM
                </a>
            </p>
        </div>
        <div>
            <p class="m-0 p-0 text-center text-sm sm:text-end">
                © <strong class="font-bold">{{ config('settings.site_name') }}.</strong> All rights reserved.
            </p>
        </div>
    </div>
</footer>
