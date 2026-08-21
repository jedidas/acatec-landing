<section class="bg-surface-alt p-4 pt-10 pb-40" id="outsourcing">
    <div class="container m-auto mb-15 xl:mb-20 py-5">

        <div class="container m-auto mb-6 py-5">
            <x-title icon="outsourcing" variant="blue" sub-heading="Soluciones sin complicaciones"
                class="mb-10">Outsourcing</x-title>

            <div class="flex flex-col-reverse lg:flex-row">

                <div class="w-full lg:w-2/5 mb-10 order-2 lg:order-1 lg:ml-20">
                    <div class="relative max-w-4/5 sm:max-w-3/5 m-auto lg:m-0 lg:max-w-full ">
                        {{-- Main image --}}
                        <picture
                            class="block h-auto w-full m-auto>
                            <source media="(max-width:
                            767px)" data-srcset="{{ asset('images/content/outsourcing.jpg') }}">

                            <source media="(min-width: 64rem)"
                                data-srcset="{{ asset('images/content/outsourcing@2x.jpg') }}">

                            <img src="{{ asset('images/content/outsourcing.jpg') }}"
                                data-src="{{ asset('images/content/outsourcing.jpg') }}" loading="lazy"
                                alt="Capacitaciones" class="lazy block h-auto w-full object-cover" width="750"
                                height="750">
                        </picture>

                        <div
                            class="w-2/6 absolute right-0 top-1/2 translate-x-1/2 -translate-y-1/2 flex flex-col gap-3">
                            <div
                                class="bg-accent-500 orange-lines aspect-square flex flex-col gap-1.5 items-center justify-center">
                                <x-icon name="award" class="block w-2/4" />
                                <span class="text-2xs md:text-xs text-white uppercase text-center">empresa
                                    galardonada</span>
                            </div>
                            {{-- Thumbnail --}}
                            <picture class="block w-full bg-white border-4 lg:border-8 border-white">
                                <img src="{{ asset('images/content/outsourcing-thumb@2x.jpg') }}"
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
                        Brindamos servicios de outsourcing en salud ocupacional de ingenieros y/o técnicos en sus
                        empresas, por jornada completa, medio tiempo, por días o por horas.
                    </p>
                    <p class="text-text-muted text-base mb-3">
                        Nuestro personal cuenta con todas las cargas sociales y equipo tecnológico a necesitar.
                    </p>
                    <p class="mb-7 text-text-muted text-base">
                        Además cada profesional está siendo supervisado y evaluado por personal con amplia experiencia.
                    </p>

                    <h3 class="text-text-light text-lg font-black mb-2">Brindamos los servicios en:</h3>
                    <ul class="list custom-list mb-7">
                        <li class="text-text-muted text-base mb-2 relative pl-3.5">
                            Industrias alimenticias, medicas, químicas.
                        </li>
                        <li class="text-text-muted text-base mb-2 relative pl-3.5">
                            Construcción.
                        <li class="text-text-muted text-base mb-2 relative pl-3.5">
                        </li>
                        <li class="text-text-muted text-base mb-2 relative pl-3.5">
                            Agricultura.
                        </li>
                        <li class="text-text-muted text-base mb-2 relative pl-3.5">
                            Comercios
                        </li>
                    </ul>

                    <x-cta variant="blue" href="#contacto">Conversemos</x-cta>

                </div>

            </div>


        </div>

</section>
