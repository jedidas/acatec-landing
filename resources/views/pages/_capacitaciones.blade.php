<section class="bg-white p-4 pt-10 pb-40" id="capacitaciones">
    <div class="container m-auto mb-15 xl:mb-20 py-5">
        <x-title icon="capacitaciones" variant="purple" sub-heading="Capacitación especializada"
            class="mb-10">Capacitaciones</x-title>

        <div class="flex flex-col-reverse lg:flex-row">

            <div class="w-full lg:w-3/5 lg:pr-30">
                <p class="mb-3 text-text-muted text-base">
                    Damos capacitaciones de trabajos críticos de persona autorizada y competente.
                </p>

                <h3 class="text-text-light text-lg font-black mb-2">Temas</h3>
                <ul class="list custom-list mb-7">
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">
                        Persona Autorizada: Trabajo en Caliente.
                    </li>
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">
                        Persona Autorizada: Trabajos en Espacios
                        Confinados.
                    </li>
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">
                        Persona Autorizada: Trabajo con
                        Electricidad.
                    </li>
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">
                        Persona Autorizada: Trabajos de Izaje y
                        manejo de cargas suspendidas.
                    </li>
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">
                        Persona Autorizada: Trabajos de Manejo de
                        Sustancias Peligrosas.
                    </li>
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">
                        Persona Autorizada: Trabajos en Altura y
                        Protección Ante Caídas.
                    </li>
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">
                        Persona Autorizada: Trabajos en Zanjas y
                        Excavaciones.
                    </li>
                </ul>

                <p class="mb-3 text-text-muted text-base">
                    Los mismos temas pero de persona <strong class="font-bold">COMPETENTE</strong>.
                </p>
                <p class="mb-7 text-text-muted text-base">
                    Nuestros instructores están certificados con OSHA 500 y 510
                </p>

                <h3 class="text-text-light text-lg font-black mb-2">Temas</h3>
                <ul class="list custom-list mb-7">
                    <li class="">
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">Ergonomía.</li>
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">Factores psicosociales.</li>
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">Análisis de riesgos.</li>
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">Primeros auxilios.</li>
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">RCP.</li>
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">Primero Auxilios psicológicos.</li>
                    <li class="text-text-muted text-base mb-2 relative pl-3.5">Temas ambientales varios… no sé cómo se
                        puede colocar.</li>
                </ul>
            </div>

            <div class="w-full lg:w-2/5 mb-10 lg:mr-20">
                <div class="relative m-auto max-w-4/5 sm:max-w-3/5 lg:max-w-full">
                    {{-- Main image --}}
                    <picture class="block h-auto w-full m-auto">
                        <source media="(max-width: 767px)"
                            data-srcset="{{ asset('images/content/capacitaciones-home.jpg') }}">

                        <source media="(min-width: 64rem)"
                            data-srcset="{{ asset('images/content/capacitaciones-home@2x.jpg') }}">

                        <img src="{{ asset('images/content/capacitaciones-home.jpg') }}"
                            data-src="{{ asset('images/content/capacitaciones-home.jpg') }}" loading="lazy"
                            alt="Capacitaciones" class="lazy block h-auto w-full object-cover" width="750"
                            height="750">
                    </picture>

                    {{-- Thumbnail --}}
                    <picture
                        class="absolute left-0 top-1/2 w-2/6 -translate-x-1/2 -translate-y-1/2 border-4 border-white bg-white lg:border-8">
                        <img src="{{ asset('images/content/capacitaciones-thumb.jpg') }}"
                            class="block aspect-square w-full object-cover" alt="capacitaciones">
                    </picture>

                    {{-- Icon --}}
                    <div
                        class="absolute bottom-1 right-1 flex aspect-square w-25 flex-col items-center justify-center gap-1 bg-primary-700 p-2 text-center lg:right-10 lg:w-35 lg:p-3 lg:translate-y-1/2">
                        <span
                            class="flex aspect-square h-2/4 w-2/4 items-center justify-center rounded-full bg-primary-800 p-1.5 lg:h-2/3 lg:w-2/3">
                            <x-icon name="learning" class="block h-2/4 w-auto fill-white lg:h-3/4" />
                        </span>

                        <p class="text-xs text-white">Aprendizaje que protege</p>
                    </div>

                </div>
            </div>
        </div>


        <div>
            <h3 class="text-text-light text-lg font-black mb-2">
                IMPORTANTE:
            </h3>
            <div class="bg-surface-alt p-4 lg:p-6 border-l-6 border-warning shadow mb-10">
                <p class="text-text-muted">
                    Las capacitaciones se dan en donde el cliente guste, en los proyectos, oficinas del cliente o bien
                    en las oficinas de ACATEC, somos muy accesibles con los horarios según las necesidades del cliente.
                </p>
            </div>
            <x-cta variant="purple" href="#contacto">Conversemos</x-cta>
        </div>

    </div>
</section>
