 <!DOCTYPE html>
 <html lang="es" class="light">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <meta name="csrf-token" content="{{ csrf_token() }}">

     @php
         $seo = $data->seo();
         $seoData = $data->seoData;
         $finalRoute = $data->finalRoute();
         $finalImage = $data->finalImage();
     @endphp

     @include('seo.meta', [
         'seo' => $seo,
         'seoData' => $seoData,
         'finalRoute' => $finalRoute,
         'finalImage' => $finalImage,
     ])
     @include('partials.favicon')
     @include('seo.schema', [
         'schema' => $seo,
         'seoData' => $seoData,
         'finalRoute' => $finalRoute,
         'finalImage' => $finalImage,
     ])

     @yield('preload')

     @routes

     <script>
         const currency = '{{ env('CURRENCY') }}';
     </script>

     @yield('script')
     @yield('css')

     @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/ts/app.ts'])

     @include('partials.tag-manager')

     @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/ts/app.ts'])
 </head>

 <body
     class="app {{ isset($css) ? $css : ($css = '') }} headroom headroom--not-bottom headroom--pinned headroom--top bg-white text-body">
     <main class="w-full">
         @include('partials.header')
         <div class="app__banner">
             @yield('banner')
         </div>
         <div class="flex flex-col">
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
 </body>

 </html>
