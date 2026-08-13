@extends('layouts.seo', ['css' => 'home-section ' . $sectionName])

@section('title')
    {{ __('Inicio') }}
@endsection

@section('banner')
    @include('partials.top-banner')
@endsection

@section('content')
    <section class="bg-gray-100 p-4">
        <div class="container m-auto mb-15 xl:mb-30 py-5">
            <x-title icon="capacitaciones" variant="purple" sub-heading="Capacitación especializada"
                class="mb-10">Capacitaciones</x-title>

            <div class="flex flex-col-reverse lg:flex-row">
                <div class="w-full lg:w-3/5 lg:pr-15">

                    <h3 class="text-text-light text-lg font-black mb-2">Ut efficitur lectus vel maximus pharetra. Fusce at
                        maximus diam.</h3>
                    <p class="text-text-muted text-base mb-3">Praesent dapibus massa nec neque blandit, ac molestie magna
                        volutpat. Vivamus vitae enim massa. Donec
                        id lacus volutpat ipsum ultrices rutrum vel ac ipsum.</p>

                    <p class="text-text-muted text-base mb-3">Proin eu mauris sit amet orci euismod faucibus. Nulla libero
                        neque,
                        varius et nisi id, efficitur
                        laoreet libero. Sed massa augue, maximus in dui finibus, semper tincidunt mi. Donec viverra eleifend
                        ipsum.</p>

                    <p class="mb-7 text-text-muted text-base">Etiam semper tincidunt mi id luctus. Donec commodo ante
                        sodales nibh laoreet, et
                        tempus
                        elit feugiat.
                        Aenean quis consequat metus, a placerat ante. In in tempor arcu. Nulla nulla massa, dignissim non
                        purus ut, semper scelerisque risus. Morbi consequat bibendum risus id efficitur. Duis posuere ornare
                        tortor eget luctus.</p>

                    <h3 class="text-text-light text-lg font-black mb-2">Mauris pellentesque convallis eros, sed</h3>
                    <ul class="list custom-list mb-7">
                        <li class="text-text-muted text-base mb-2 relative pl-3.5">
                            Pellentesque ac imperdiet erat, a placerat ante. In in tempor arcu feugiat massa aellentesque ac
                            imperdiet erat, a feugiat massa.
                        </li>
                        <li class="text-text-muted text-base mb-2 relative pl-3.5">
                            Praesent maximus sem quam, at facilisis nisl pulvinar faucibus.
                        </li>
                        <li class="text-text-muted text-base mb-2 relative pl-3.5">
                            In hendrerit, sapien nec pulvinar ultrices, ante diam hendrerit leo, vel eleifend eros urna sed
                            nibh.
                        </li>
                        <li class="text-text-muted text-base mb-2 relative pl-3.5">
                            Aenean ultrices urna ut tortor sagittis, ac porta nulla laoreet.
                        </li>
                        <li class="text-text-muted text-base mb-2 relative pl-3.5">
                            Vivamus congue urna nec leo tempor interdum.
                        </li>
                        <li class="text-text-muted text-base mb-2 relative pl-3.5">
                            Praesent pretium cursus lectus, nec auctor nisi tincidunt sit amet.
                        </li>
                        <li class="text-text-muted text-base mb-2 relative pl-3.5">
                            Donec euismod metus non mi interdum, eget varius sapien aliquam.
                        </li>
                        <li class="text-text-muted text-base mb-2 relative pl-3.5">
                            Integer id orci tortor. Vestibulum vel finibus nisi, non condimentum ipsum.
                        </li>
                    </ul>


                    <div class="bg-surface-alt p-6 border-l-6 border-warning shadow mb-10">
                        <p class="text-text-muted">Invertir en capacitación es invertir en la seguridad, el bienestar y el
                            crecimiento de su
                            organización.</p>
                    </div>

                    <x-cta variant="purple" href="#">Conversemos</x-cta>

                </div>
                <div class="w-full lg:w-2/5 mb-10">
                    <picture class="block h-auto w-full max-w-4/5 sm:max-w-3/5 m-auto lg:max-w-full">
                        <source media="(max-width: 767px)"
                            data-srcset="{{ asset('images/content/capacitaciones-home.png') }}">
                        <source media="(min-width: 64rem)"
                            data-srcset="{{ asset('images/content/capacitaciones-home@2x.png') }}">
                        <img src="{{ asset('images/content/capacitaciones-home.png') }}"
                            data-src="{{ asset('images/content/capacitaciones-home.png') }}" loading="lazy"
                            alt="Capacitaciones" class="lazy block h-auto w-full object-cover" width="750"
                            height="750">
                    </picture>

                </div>
            </div>

        </div>

        <div class="container m-auto mb-6 py-5">
            <x-title icon="outsourcing" variant="blue" sub-heading="Soluciones sin complicaciones">Outsourcing</x-title>
        </div>

        <div class="container m-auto mb-6 py-5">
            <x-title icon="planes" variant="green" sub-heading="Estrategias para crecer seguro">Planes y
                programas</x-title>
        </div>

        <div class="container m-auto mb-6 py-5">
            <x-title icon="bandera" variant="blue" sub-heading="Compromiso con el ambiente">
                Bandera azul
            </x-title>
        </div>

        <div class="container m-auto mb-6 py-5">
            <x-title icon="servicios" variant="orange" sub-heading="Aliados para su crecimiento">
                Servicios
            </x-title>
        </div>

    </section>
@endsection

@section('bottom-section')
@endsection
