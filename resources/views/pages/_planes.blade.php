 <section class="section-lavender bg-lavender-50 bg-image p-4 pt-10 pb-40" id="planes">
     <div class="container m-auto mb-15 xl:mb-20 py-5">

         <x-title icon="planes" variant="green" sub-heading="Estrategias para crecer seguro" class="mb-10">
             Planes y programas
         </x-title>

         <div class="flex flex-col-reverse lg:flex-row">

             <div class="w-full lg:w-3/5 lg:pr-30">
                 <p class="mb-3 text-text-muted text-base">
                     Realizamos documentos legales como:
                 </p>
                 <ul class="list custom-list mb-7">
                     <li class="text-text-muted text-base mb-2 relative pl-3.5">
                         Plan de preparativos y respuesta ante emergencias.
                     <li class="text-text-muted text-base mb-2 relative pl-3.5">
                         Programa de salud ocupacional.
                     </li>
                     <li class="text-text-muted text-base mb-2 relative pl-3.5">
                         Plan de manejo de desechos sólidos.
                     </li>
                     <li class="text-text-muted text-base mb-7 relative pl-3.5">
                         Plan de gestión ambiental.
                     </li>
                 </ul>
                 <x-cta variant="green" href="#contacto">Conversemos</x-cta>


             </div>

             <div class="w-full lg:w-2/5 mb-10 lg:mr-20">
                 <div class="relative m-auto max-w-4/5 sm:max-w-3/5 lg:max-w-full">
                     {{-- Main image --}}
                     <picture class="block h-auto w-full m-auto">
                         <source media="(max-width: 767px)" data-srcset="{{ asset('images/content/servicios.jpg') }}">

                         <source media="(min-width: 64rem)"
                             data-srcset="{{ asset('images/content/servicios@2x.jpg') }}">

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
                         class="absolute bottom-1 right-1 flex aspect-square w-25 flex-col items-center justify-center gap-1 bg-success-500 p-2 text-center lg:right-10 lg:w-35 lg:p-3 lg:translate-y-1/2">
                         <span
                             class="flex aspect-square h-2/4 w-2/4 items-center justify-center rounded-full bg-success-600 p-1.5 lg:h-2/3 lg:w-2/3">
                             <x-icon name="learning" class="block h-2/4 w-auto fill-white lg:h-3/4" />
                         </span>

                         <p class="text-xs text-white">Programas empresarial</p>
                     </div>

                 </div>

             </div>
         </div>
     </div>


     </div>
 </section>
