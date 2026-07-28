<x-mail::message>
# Correo de sitio web

**Nombre:** {{$name}}

**Asunto:** {{$topic}}

**Teléfono:** {{$phone}}

**Correo:** {{$email}}

**Mensaje:**

{{$content}}

<x-mail::button :url="route('home.index')">
Visitar Sitio Web
</x-mail::button>

Gracias,<br>
{{ config('settings.site_name') }}
</x-mail::message>
