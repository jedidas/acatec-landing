<x-mail::message>
# Confirmación de correo de sitio web

Hola, **{{$name}}**, hemos recibido su correo. Uno de nuestros agentes se pondrá en contacto con usted lo antes posible.

<x-mail::button :url="route('home.index')">
Visitar Sitio Web
</x-mail::button>

Gracias,<br>
{{ config('settings.site_name') }}
</x-mail::message>
