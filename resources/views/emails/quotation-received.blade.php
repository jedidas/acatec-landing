<x-mail::message>
# Correo de sitio web

**Nombre:** {{$name}}

**Teléfono:** {{$phone}}

**Correo:** {{$email}}

**Mensaje:**

{{$content}}

<table width="100%" cellpadding="6" cellspacing="0" style="border-collapse: collapse;">
<thead>
<tr style="border-bottom:1px solid #ddd;">
<th align="left" width="90">Imagen</th>
<th align="left">Nombre</th>
<th align="center" width="80">Cantidad</th>
</tr>
</thead>

<tbody>
@foreach ($products as $product)
<tr style="border-bottom:1px solid #eee;">
<td>
@if(!empty($product['base64Image']))
<img src="data:image/png;base64,{{$product['base64Image']}}" width="60" style="display:block;">
@endif
</td>

<td>
<a href="{{$product['url'] ?? '#'}}">
{{$product['name'] ?? ''}}
</a>
</td>

<td align="center">
{{$product['quantity'] ?? ''}}
</td>
</tr>
@endforeach
</tbody>
</table>

<x-mail::button :url="route('filament.admin.resources.quotations.view',$id)">
Ir a cotización
</x-mail::button>

Gracias,<br>
{{ config('settings.site_name') }}
</x-mail::message>
