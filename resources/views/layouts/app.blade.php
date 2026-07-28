 <!DOCTYPE html>
 <html lang="es" class="light">

 <head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <meta http-equiv="X-UA-Compatible" content="ie=edge" />
     <meta name="csrf-token" content="{{ csrf_token() }}" />
     <title>
         @yield('title') | {{ config('settings.site_name') }} - {{ config('settings.site_slogan') }}
     </title>

     <link rel="preconnect" href="https://fonts.googleapis.com" />
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
     <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
         rel="stylesheet" />
     <script src="https://www.google.com/recaptcha/api.js?render={{ env('reCAPTCHA_site_key') }}"></script>

     @routes

     <script>
         const currency = '{{ env('CURRENCY') }}';
     </script>

     @include('partials.seo')
     @include('partials.favicon')
     @include('partials.tag-manager')

     @yield('preload')
     @yield('script')
     @yield('css')

     @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/ts/app.ts'])
 </head>

 <body
     class="app {{ isset($css) ? $css : ($css = '') }} headroom headroom--not-bottom headroom--pinned headroom--top bg-white text-body">
     <main class="w-full">
         @include('partials.header')
         <div class="app__banner">
             @yield('banner')
             <div class="bg-amber-300 lg:relative">
                 <button class="p-3">
                     Explorar categorías
                 </button>
             </div>
         </div>
         <div class="flex-1 grid lg:grid-cols-[250px_1fr]">
             @include('partials.main-menu')
             <div class="flex flex-col justify-between overflow-hidden">
                 <section>
                     @yield('content')
                     @yield('bottom-section')
                     @include('partials.footer')
                 </section>
             </div>
         </div>
     </main>
     <a href="https://api.whatsapp.com/send?phone=+506{{ config('settings.whatsapp_number') }}" target="_blank"
         rel="noopener noreferrer" class="fixed top-1/2 right-0 md:right-4 z-10 -translate-1/2">
         <x-icon name="whatsapp" class="block h-8 w-8" />
     </a>
     @include('partials.search-modal')
 </body>

 </html>
