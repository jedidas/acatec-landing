@php
    $socialNetworks = json_decode(config('settings.social_networks'));
    $telephoneNumbers = json_decode(config('settings.telephone_number'));
    $schedules = json_decode(config('settings.schedule'));
@endphp
<div>
    <iframe class="lazy h-60 w-full" data-src="{{ config('settings.map_iframe') }}" width="600" height="450"
        style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<footer class="bg-primary-700" id="contacto">
    <div class="bg-accent-500 h-28"></div>
    <section class="container m-auto mb-10 flex w-full flex-col-reverse justify-between gap-6 px-3 lg:flex-row">
        <div class="w-full lg:w-1/2 pt-10">

            <div class="bg-primary-800/90 backdrop-blur-md mb-5 p-10 py-5">
                <x-title icon="outsourcing" variant="white" sub-heading="Aliados para su crecimiento">Contacto</x-title>
            </div>

            <div class="bg-primary-800/90 backdrop-blur-md p-10">
                <p class="mb-6 text-sm text-white">
                    {{ __('Para conocer más sobre nuestros productos y servicios, escríbanos y con gusto te atenderemos.') }}
                </p>
                @include('partials.contact-form')
            </div>
        </div>
        <div class="flex flex-col w-full lg:w-auto">

            <div class="inline-block bg-primary-800/90 backdrop-blur-md mb-5 p-7 pt-5 lg:max-w-96 w-full -mt-16">

                <h3 class="flex items-center gap-3 text-white font-bold mb-6">
                    <x-icon name="info" class="h-8 w-8 fill-accent-500" />
                    {{ __('Información') }}
                </h3>

                <h4 class="font-bold text-white text-dark-orange mb-3">{{ __('Síguenos en') }}</h4>
                <ul class="flex flex-col gap-4 mb-6">
                    @foreach ($socialNetworks as $network)
                        <li>
                            <p>
                                <a href="{{ $network->url }}"
                                    class="inline-flex items-center gap-3 text-white hover:text-warning underline text-sm lg:text-base hover:text-dark-orange"
                                    target="_blank" rel="noopener noreferrer">
                                    <x-icon name="{{ $network->networks }}" class="h-5 w-5 fill-accent-500" />
                                    {{ $network->name }}
                                </a>
                            </p>
                        </li>
                    @endforeach
                </ul>

                <h4 class="font-bold text-white text-dark-orange mb-3">{{ __('Información del contacto') }}</h4>
                <ul class="flex flex-col gap-4">
                    <li>
                        <div class="flex relative pl-8">
                            <x-icon name="schedule"
                                class="absolute fill-primary self-center left-0 h-5 w-5 fill-accent-500" />
                            <div>
                                <p class="flex items-center gap-3 text-white text-sm">
                                    Horario
                                </p>
                                @foreach ($schedules as $schedule)
                                    <p class="flex items-center gap-3 text-white text-sm">
                                        {{ $schedule->value }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="flex relative pl-8">
                            <x-icon name="location"
                                class=" fill-accent-500 absolute fill-primary self-center left-0 h-5 w-5" />
                            <div>
                                <p class="flex items-center gap-3 text-white text-sm">
                                    Curridabat
                                </p>
                                <p class="flex items-center gap-3 text-white text-sm">
                                    {{ config('settings.address_locality') }}, Costa Rica
                                </p>
                            </div>
                        </div>
                    </li>

                    <li>
                        <p>
                            <a href="mailto:{{ config('settings.site_email') }}"
                                class="inline-flex items-center gap-3 text-white hover:text-warning underline text-sm lg:text-base hover:text-dark-orange"
                                target="_blank" rel="noopener noreferrer">
                                <x-icon name="email" class="h-5 w-5 fill-accent-500" />
                                {{ config('settings.site_email') }}
                            </a>
                        </p>
                    </li>

                    <li>
                        <p>
                            <a href="mailto:{{ config('settings.quote_email') }}"
                                class="inline-flex items-center gap-3 text-white hover:text-warning underline text-sm lg:text-base hover:text-dark-orange"
                                target="_blank" rel="noopener noreferrer">
                                <x-icon name="email" class="h-5 w-5 fill-accent-500" />
                                {{ config('settings.quote_email') }}
                            </a>
                        </p>
                    </li>


                    @if (config('settings.waze'))
                        <li>
                            <p>
                                <a href="{{ config('settings.waze') }}"
                                    class="inline-flex items-center gap-3 text-white hover:text-warning underline text-sm lg:text-base hover:text-dark-orange"
                                    target="_blank" rel="noopener noreferrer">
                                    <x-icon name="waze" class="h-5 w-5 fill-accent-500" />
                                    ACATEC
                                </a>
                            </p>
                        </li>
                    @endif
                    @foreach ($telephoneNumbers ?? [] as $telephone)
                        <li>
                            <p>
                                @if ($telephone->is_whatsapp)
                                    <a href="https://api.whatsapp.com/send?phone=+506{{ $telephone->number }}"
                                        class="inline-flex items-center gap-3 text-white hover:text-warning underline text-sm lg:text-base hover:text-dark-orange"
                                        target="_blank" rel="noopener noreferrer">
                                        <x-icon name="whatsapp-lines" class="h-5 w-5 fill-accent-500" />
                                        {{ $telephone->visible_number }}
                                    </a>
                                @else
                                    <a href="mailto:{{ $telephone->number }}"
                                        class="inline-flex items-center gap-3 text-white hover:text-warning underline text-sm lg:text-base hover:text-dark-orange"
                                        target="_blank" rel="noopener noreferrer">
                                        <x-icon name="phone" class="h-5 w-5 fill-accent-500" />
                                        {{ $telephone->visible_number }}
                                    </a>
                                @endif
                            </p>
                        </li>
                    @endforeach

                </ul>
            </div>

            <div class="inline-block mb-5 bg-primary-800/90 backdrop-blur-md p-7 lg:max-w-96 w-full">
                <nav class="ul">
                    <h4 class="font-bold text-white text-dark-orange mb-3">{{ __('Menu') }}</h4>
                    <ul class="flex flex-col gap-0">
                        <li class="relative pl-5">
                            <x-icon name="bullet" class="absolute left-1 top-[50%] translate-[-50%]" />
                            <a href="{{ route('home.index') }}"
                                class="inline-block text-sm lg:text-base p-1 text-white hover:text-warning">
                                {{ __('Inicio') }}
                            </a>
                        </li>
                        <li class="relative pl-5">
                            <x-icon name="bullet" class="absolute left-1 top-[50%] translate-[-50%]" />
                            <a href="#capacitaciones" data-href="capacitaciones"
                                class="wd-scroll inline-block text-sm lg:text-base p-1 text-white hover:text-warning">
                                {{ __('Capacitaciones') }}
                            </a>
                        </li>
                        <li class="relative pl-5">
                            <x-icon name="bullet" class="absolute left-1 top-[50%] translate-[-50%]" />
                            <a href="#outsourcing" data-href="outsourcing"
                                class="wd-scroll inline-block text-sm lg:text-base p-1 text-white hover:text-warning">
                                {{ __('Outsourcing') }}
                            </a>
                        </li>
                        <li class="relative pl-5">
                            <x-icon name="bullet" class="absolute left-1 top-[50%] translate-[-50%]" />
                            <a href="#planes" data-href="planes"
                                class="wd-scroll inline-block text-sm lg:text-base p-1 text-white hover:text-warning">
                                {{ __('Planes y programas') }}
                            </a>
                        </li>
                        <li class="relative pl-5">
                            <x-icon name="bullet" class="absolute left-1 top-[50%] translate-[-50%]" />
                            <a href="#bandera" data-href="bandera"
                                class="wd-scroll inline-block text-sm lg:text-base p-1 text-white hover:text-warning">
                                {{ __('Bandera azul') }}
                            </a>
                        </li>
                        <li class="relative pl-5">
                            <x-icon name="bullet" class="absolute left-1 top-[50%] translate-[-50%]" />
                            <a href="#servicios" data-href="servicios"
                                class="wd-scroll inline-block text-sm lg:text-base p-1 text-white hover:text-warning">
                                {{ __('Servicios') }}
                            </a>
                        </li>
                        <li class="relative pl-5">
                            <x-icon name="bullet" class="absolute left-1 top-[50%] translate-[-50%]" />
                            <a href="#contacto" data-href="contacto"
                                class="wd-scroll inline-block text-sm lg:text-base p-1 text-white hover:text-warning">
                                {{ __('Contacto') }}
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </section>
    <div class=" bg-primary-600 px-5 py-3 text-white">
        <div class="container m-auto flex flex-col justify-center gap-2  sm:flex-row sm:justify-between">
            <div>
                <p class="m-0 p-0 text-center text-sm sm:text-start">
                    Designed and developed by
                    <a class="font-bold underline text-sm hover:text-accent-500" href="https://ambideas.com"
                        target="_blank" rel="noopener noreferrer">
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
    </div>
</footer>
