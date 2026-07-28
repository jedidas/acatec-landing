@php
    $schedules = json_decode(config('settings.schedule'));
@endphp
<header class="header">
    <button class="bg-orange hamburger hamburger--stand wd-mobile-menu">
        <span class="hamburger-box">
            <span class="hamburger-inner"></span>
        </span>
    </button>
    {{-- Top Contact Bar --}}
    <div class="bg-orange text-white">
        <section class="mx-auto p-3 px-3 lg:py-4 sm:px-6 lg:container flex gap-2 justify-between py-3 pb-2">
            <ul class="flex w-full justify-start items-center gap-2 lg:w-1/2">
                <li>
                    <a href="mailto:{{ config('settings.site_email') }}"
                        class="flex items-center justify-center gap-2 text-nowrap text-white" target="_blank"
                        rel="noopener noreferrer">
                        <x-icon name="email" class="h-5 w-5" />
                        <span class="hidden md:block text-sm">{{ config('settings.site_email') }}</span>
                    </a>
                </li>

                <li>
                    <a href="tel:{{ config('settings.telephone') }}"
                        class="flex items-center justify-center gap-2 text-nowrap text-white" target="_blank"
                        rel="noopener noreferrer">
                        <x-icon name="phone" class="h-5 w-5" />
                        <span class="hidden md:block text-sm text-white">{{ config('settings.telephone_name') }}</span>
                    </a>
                </li>

                <li class="hidden md:flex items-center justify-center gap-2 text-nowrap text-white">
                    <x-icon name="schedule" class="h-5 w-5" />
                    @foreach ($schedules as $schedule)
                        <span class="text-sm">
                            {{ $schedule->value }}
                        </span>
                    @endforeach
                </li>
            </ul>

            @php
                $socialNetworks = json_decode(config('settings.social_networks'));
            @endphp

            {{-- Social Icons --}}
            <ul class=" flex items-center w-full justify-end gap-2 lg:w-1/2">
                @foreach ($socialNetworks as $network)
                    <li>
                        <a href="{{ $network->url }}" target="_blank" rel="noopener noreferrer">
                            <x-icon name="{{ $network->networks }}" class="text-dark-orange h-5 w-5" />
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="flex gap-2">
                <button data-modal-target="search-modal" data-modal-toggle="search-modal" type="button"
                    class="text-white cursor-pointer block">
                    <x-icon name="search" class="h-5 w-5" />
                </button>
                <a href="{{ route('favorites.index') }}" class="block text-sm">
                    <x-icon name="favorite" class="h-5 w-5" />
                </a>
                <a href="{{ route('cart.index') }}" class="block relative transition-all">
                    <span
                        class="block absolute aspect-square text-xs h-5 w-5 leading-5 rounded-full bg-black font-bold text-white text-center -right-2.5 -top-2.5 z-10"
                        id="shopBagCounter">0</span>
                    <x-icon name="shop-bag" class="h-5 w-5 icon" />
                </a>
            </div>
        </section>
    </div>

    {{-- Logo + Navigation --}}
    <div class="bg-white">
        <section class="mx-auto p-3 px-3 lg:py-4 sm:px-6 lg:container flex justify-between">
            <div class="w-full lg:w-1/2">
                <a href="{{ route('home.index') }}" class="block w-auto" title="{{ config('settings.site_slogan') }}">
                    <img src="{{ asset('images/logos/logotype.svg') }}" alt="{{ config('settings.site_name') }}"
                        class="block w-28 lg:w-40" />
                </a>
            </div>

            <nav class="w-full lg:w-1/2">
                <ul class="flex h-full items-center justify-end gap-2">
                    <li>
                        <a href="{{ route('home.index') }}" class="block h-full text-sm">
                            {{ __('Inicio') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about.index') }}" class="block h-full text-sm">
                            {{ __('Nosotros') }}
                        </a>
                    </li>
                    <li>
                        <a href="#contact-form" data-href="contact-form" class="wd-scroll block h-full text-sm">
                            {{ __('Contacto') }}
                        </a>
                    </li>
                </ul>
            </nav>
        </section>
    </div>
</header>
