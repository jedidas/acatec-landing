<section class="bg-white p-4  pt-10 pb-40" id="bandera">
    <div class="container m-auto mb-15 xl:mb-20 py-5">
        <x-title icon="bandera" variant="blue" sub-heading="Compromiso con el ambiente" class="mb-10">
            Bandera azul
        </x-title>


        <div class="flex flex-col-reverse lg:flex-row">

            <div class="w-full lg:w-2/5 mb-10 order-2 lg:order-1 lg:ml-20">
                <div class="relative max-w-4/5 sm:max-w-3/5 m-auto lg:m-0 lg:max-w-full ">
                    {{-- Main image --}}
                    <picture class="block h-auto w-full m-auto>
                            <source media="(max-width:
                        767px)" data-srcset="{{ asset('images/content/bandera.jpg') }}">

                        <source media="(min-width: 64rem)" data-srcset="{{ asset('images/content/bandera@2x.jpg') }}">

                        <img src="{{ asset('images/content/bandera.jpg') }}"
                            data-src="{{ asset('images/content/bandera.jpg') }}" loading="lazy" alt="Capacitaciones"
                            class="lazy block h-auto w-full object-cover" width="750" height="750">
                    </picture>

                    <div class="w-2/6 absolute right-0 top-1/2 translate-x-1/2 -translate-y-1/2 flex flex-col gap-3">
                        <div
                            class="bg-secondary-500 blue-lines aspect-square flex flex-col gap-1.5 items-center justify-center">
                            <x-icon name="blue-flag" class="block w-2/4" />
                            <span class="text-xs text-white uppercase text-center">Gestión sostenible</span>
                        </div>
                        {{-- Thumbnail --}}
                        <picture class="block w-full bg-white border-4 lg:border-8 border-white">
                            <img src="{{ asset('images/content/bandera-thumb.jpg') }}"
                                class="block aspect-square w-full object-cover" alt="capacitaciones">
                        </picture>
                    </div>

                    {{-- Icon --}}
                    <div
                        class="absolute bottom-1 left-1 lg:left-10 flex aspect-square w-25 lg:w-35 flex-col items-center justify-center gap-1 bg-secondary-500 p-2 text-center lg:p-3 lg:translate-y-1/2">
                        <span
                            class="flex aspect-square h-2/4 w-2/4 items-center justify-center rounded-full bg-secondary-600 p-1.5 lg:h-2/3 lg:w-2/3">
                            <x-icon name="flag" class="block h-2/4 w-auto fill-white lg:h-3/4" />
                        </span>
                        <p class="text-xs text-white">Acciones para un futuro mejor</p>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-3/5 lg:pl-35 order-1 lg:order-2">
                <p class="text-text-muted text-base mb-3">
                    Realizamos la gestión y acompañamiento para obtener el galardón de bandera azul en las diferentes
                    categorías:
                </p>
                <p class="mb-7 text-text-muted text-base">
                    Playa, comunidades, centros educativos, eventos especiales, cambio climáticos, entre otros.
                </p>
                <x-cta variant="blue" href="#contacto">Conversemos</x-cta>
            </div>

        </div>

    </div>
</section>
