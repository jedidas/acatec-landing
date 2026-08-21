<section class="bg-neutral-50 pb-40 pt-10 p-4" id="servicios">
    <div class="container m-auto mb-6 py-5">
        <x-title icon="servicios" variant="orange" sub-heading="Aliados para su crecimiento" class="mb-10">
            Servicios
        </x-title>

        <div class="flex flex-col-reverse lg:flex-row">

            <div class="w-full lg:w-3/5 lg:pr-35">
                <p class="mb-3 text-text-muted text-base">
                    También realizamos servicios de:
                </p>


                <ul class="list custom-list mb-7">
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">
                        Evaluación de riesgos.
                    </li>
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">
                        Investigación y análisis de incidentes.
                    </li>
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">
                        Comisiones y oficinas de Salud Ocupacional.</li>
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">
                        Cumplimiento legal.</li>
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">
                        Señalización y rotulación.</li>
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">
                        Ergonomía, estudios ergonómicos.</li>
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">
                        Venta de equipo de protección personal.
                    </li>
                    <li class="text-text-muted text-base mb-7 relative pl-3.5">
                        Medicos laborales.
                    </li>
                </ul>

                <x-cta variant="orange" href="#contacto">Conversemos</x-cta>


            </div>

            <div class="w-full lg:w-2/5 mb-10 lg:mr-20">
                <div class="relative m-auto max-w-4/5 sm:max-w-3/5 lg:max-w-full">
                    {{-- Main image --}}
                    <picture class="block h-auto w-full m-auto">
                        <source media="(max-width: 767px)" data-srcset="{{ asset('images/content/servicios.jpg') }}">

                        <source media="(min-width: 64rem)" data-srcset="{{ asset('images/content/servicios@2x.jpg') }}">

                        <img src="{{ asset('images/content/servicios.jpg') }}"
                            data-src="{{ asset('images/content/servicios.jpg') }}" loading="lazy" alt="Capacitaciones"
                            class="lazy block h-auto w-full object-cover" width="750" height="750">
                    </picture>

                    {{-- Thumbnail --}}
                    <picture
                        class="absolute left-0 top-1/2 w-2/6 -translate-x-1/2 -translate-y-1/2 border-4 border-white bg-white lg:border-8">
                        <img src="{{ asset('images/content/servicios-thumb.jpg') }}"
                            class="block aspect-square w-full object-cover" alt="capacitaciones">
                    </picture>

                    {{-- Icon --}}
                    <div
                        class="absolute bottom-1 right-1 flex aspect-square w-25 flex-col items-center justify-center gap-1 bg-accent-500 p-2 text-center lg:right-10 lg:w-35 lg:p-3 lg:translate-y-1/2">
                        <span
                            class="flex aspect-square h-2/4 w-2/4 items-center justify-center rounded-full bg-accent-600 p-1.5 lg:h-2/3 lg:w-2/3">
                            <x-icon name="learning" class="block h-2/4 w-auto fill-white lg:h-3/4" />
                        </span>

                        <p class="text-xs text-white">Protección empresarial</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
