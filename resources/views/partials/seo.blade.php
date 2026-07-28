{{-- SEO --}}
<meta name="robots" content="index, follow">

{{-- Open Graph --}}
<meta property="og:title"
    content="@yield('title') | {{ config('settings.site_name') }} - {{ config('settings.site_slogan') }}" />
<meta property="og:description" content="{{ config('settings.og_description') }}" />
<meta property="og:image" content="@yield('image', asset('images/social/social.jpg'))" />
<meta property="og:url" content="{{ Request::url() }}" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="{{ config('settings.site_name') }}">
<meta property="og:locale" content="es_CR">

{{-- Twitter Cards --}}
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title"
    content="@yield('title') | {{ config('settings.site_name') }} - {{ config('settings.site_slogan') }}" />
<meta name="twitter:description" content="{{ config('settings.og_description') }}" />
<meta name="twitter:image" content="@yield('image', asset('images/social/social.jpg'))" />
<meta name="twitter:url" content="{{ Request::url() }}" />

{{-- WhatsApp --}}
<meta property="og:image" content="@yield('image', asset('images/social/social.jpg'))" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />

{{-- Facebook Instant Articles --}}
<meta property="ia:markup_url" content="{{ Request::url() }}">
<meta property="ia:rules_url" content="{{ Request::url() }}">

{{-- Author --}}
<link rel="canonical" href="{{ request()->url() }}">
