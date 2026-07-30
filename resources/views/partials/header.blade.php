@php
    $schedules = json_decode(config('settings.schedule'));
@endphp

<button class="bg-accent-500 hamburger hamburger--stand wd-mobile-menu">
    <span class="hamburger-box">
        <span class="hamburger-inner"></span>
    </span>
</button>

<header class="flex flex-col lg:flex-row">

    {{-- Top Contact Bar --}}
    <div class="top-bar bg-primary-700 flex items-center justify-start lg:justify-center p-6 py-4">
        <a href="{{ route('home.index') }}" class="block h-14 w-14 xl:w-[180px]"
            title="{{ config('settings.site_slogan') }}">
            <picture class="block static-logotype">
                <source srcset="{{ asset('images/logos/logotype.svg') }}" media="(min-width: 1280px)" />
                <img src="{{ asset('images/logos/logotype-small.svg') }}" alt="{{ config('settings.site_name') }}"
                    class="block w-full" />
            </picture>
            <img src="{{ asset('images/logos/logotype-small.svg') }}" alt="{{ config('settings.site_name') }}"
                class="hidden w-full fixed-logotype" />
        </a>
    </div>

    {{-- Logo + Navigation --}}
    <div class="bg-white w-full">

        <section class="top-info-bar h-10 absolute lg:static right-0 top-3 lg:pl-8 xl:pl-16 lg:w-full">
            <div class="top-info-container lg:bg-primary-700 flex justify-center lg:justify-end gap-5 p-2.5 pr-6">
                <ul class="flex gap-5">
                    <li>
                        <a href="mailto:{{ config('settings.site_email') }}"
                            class="flex items-center justify-center gap-2 text-nowrap text-white hover:text-accent-500"
                            target="_blank" rel="noopener noreferrer">
                            <x-icon name="email" class="h-5 w-5 fill-white" />
                            <span class="hidden md:block text-sm">{{ config('settings.site_email') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="tel:{{ config('settings.whatsapp_number') }}"
                            class="flex items-center justify-center gap-2 text-nowrap text-white hover:text-accent-500"
                            target="_blank" rel="noopener noreferrer">
                            <x-icon name="whatsapp-lines" class="h-5 w-5 fill-white" />
                            <span class="hidden md:block text-sm">{{ config('settings.whatsapp') }}</span>
                        </a>
                    </li>
                </ul>

                @php
                    $socialNetworks = json_decode(config('settings.social_networks'));
                @endphp

                {{-- Social Icons --}}
                <ul class="flex gap-5">
                    @foreach ($socialNetworks as $network)
                        <li>
                            <a href="{{ $network->url }}"class="flex items-center justify-center gap-2 text-nowrap text-white hover:text-accent-500"
                                target="_blank" rel="noopener noreferrer">
                                <x-icon name="{{ $network->networks }}" class="h-5 w-5 fill-white" />
                                <span class="hidden md:block text-sm">{{ $network->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <nav
            class="main-menu p-3 lg:p-0 fixed top-0 -left-full h-lvh lg:static lg:h-20 lg:pl-7 xl:pl-12 w-64 lg:w-full z-30 transition-all duration-300">
            <ul
                class="main-menu-list border border-white/15 bg-white/50 backdrop-blur-md shadow rounded-md lg:border-0 overflow-auto lg:overflow-hidden lg:shadow-none lg:rounded-0 flex flex-col lg:flex-row h-full items-center justify-start gap-1 lg:gap-2 text-primary-700">
                <li class="w-full lg:w-auto lg:hidden">
                    <div class="bg-primary-700 rounded-md rounded-b-0 p-3 py-6">
                        <img src="{{ asset('images/logos/logotype.svg') }}" alt="{{ config('settings.site_name') }}"
                            class="block m-auto w-32" />
                    </div>
                </li>
                <li class="w-full lg:w-auto">
                    <a href="{{ route('home.index') }}"
                        class="block h-full text-sm lg:text-base p-4 hover:text-warning">
                        {{ __('Inicio') }}
                    </a>
                </li>
                <li class="w-full lg:w-auto">
                    <a href="#capacitaciones" data-href="capacitaciones"
                        class="wd-scroll block h-full text-sm lg:text-base p-4 hover:text-warning">
                        {{ __('Capacitaciones') }}
                    </a>
                </li>
                <li class="w-full lg:w-auto">
                    <a href="#outsourcing" data-href="outsourcing"
                        class="wd-scroll block h-full text-sm lg:text-base p-4 hover:text-warning">
                        {{ __('Outsourcing') }}
                    </a>
                </li>
                <li class="w-full lg:w-auto">
                    <a href="#planes" data-href="planes"
                        class="wd-scroll block h-full text-sm lg:text-base p-4 hover:text-warning">
                        {{ __('Planes y programas') }}
                    </a>
                </li>
                <li class="w-full lg:w-auto">
                    <a href="#bandera" data-href="bandera"
                        class="wd-scroll block h-full text-sm lg:text-base p-4 hover:text-warning">
                        {{ __('Bandera azul') }}
                    </a>
                </li>
                <li class="w-full lg:w-auto">
                    <a href="#servicios" data-href="servicios"
                        class="wd-scroll block h-full text-sm lg:text-base p-4 hover:text-warning">
                        {{ __('Servicios') }}
                    </a>
                </li>
                <li class="w-full lg:w-auto">
                    <a href="#contacto" data-href="contacto"
                        class="wd-scroll block h-full text-sm lg:text-base p-4 hover:text-warning">
                        {{ __('Contacto') }}
                    </a>
                </li>
                <li class="w-full lg:w-auto lg:hidden">
                    <div class="p-2 py-3">
                        {{-- Social Icons --}}
                        <ul class="border border-white/15 bg-white/5 backdrop-blur-md shadow rounded-md flex gap-3 p-2">

                            <li>
                                <a href="tel:{{ config('settings.telephone') }}"
                                    class="flex items-center justify-center gap-1 text-nowrap p-1! not-first-of-type: hover:text-accent-500"
                                    target="_blank" rel="noopener noreferrer">
                                    <x-icon name="phone" class="h-5 w-5 fill-primary-700" />
                                </a>
                            </li>

                            <li>
                                <a href="https://api.whatsapp.com/send?phone=+506{{ config('settings.whatsapp_number') }}"
                                    class="flex items-center justify-center gap-1 text-nowrap p-1! not-first-of-type: hover:text-accent-500"
                                    target="_blank" rel="noopener noreferrer">
                                    <x-icon name="whatsapp-lines" class="h-5 w-5 fill-primary-700" />
                                </a>
                            </li>

                            @foreach ($socialNetworks as $network)
                                <li>
                                    <a href="{{ $network->url }}"
                                        class="flex items-center justify-center gap-1 text-nowrap p-1! not-first-of-type: hover:text-accent-500"
                                        target="_blank" rel="noopener noreferrer">
                                        <x-icon name="{{ $network->networks }}" class="h-5 w-5 fill-primary-700" />
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>

            </ul>
        </nav>
    </div>
</header>
