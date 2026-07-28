{{-- Title --}}
@if (empty($seo->title))
    <title>
        @yield('title') | {{ config('settings.site_name') }} - {{ config('settings.site_slogan') }}
    </title>
@else
    <title>{{ $seo->title }} | {{ config('settings.site_name') }}</title>
@endif

{{-- Basic SEO --}}
<meta name="description" content="{{ $seo->description }}">
<meta name="robots" content="{{ $seo->robots }}">
<link rel="canonical" href="{{ $finalRoute }}">

{{-- Open Graph --}}
<meta property="og:title" content="{{ $seo->og['title'] }}">
<meta property="og:description" content="{{ $seo->og['description'] }}">
<meta property="og:image" content="{{ asset($finalImage) }}">
<meta property="og:image:alt" content="{{ $seo->title }}">
<meta property="og:url" content="{{ $finalRoute }}">
<meta property="og:type" content="website">

{{-- Twitter --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seo->twitter['title'] }}">
<meta name="twitter:description" content="{{ $seo->twitter['description'] }}">
<meta name="twitter:image" content="{{ asset($finalImage) }}">
<meta property="og:site_name" content="{{ config('settings.site_name') }}">
<meta property="og:locale" content="es_CR">
