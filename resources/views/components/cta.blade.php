<div {{ $attributes->merge([
    'class' => 'cta-component flex mb-10 ' . $attributes->get('variant'),
]) }}>
    <a href="{{ $attributes->has('href') ? $attributes->get('href') : '#' }}"
        class="flex items-center border-10 border-l-0 border-t-0 relative p-3! pl-5! pt-5! justify-center gap-3 uppercase font-bold transition duration-200">
        {{ $slot }}
        <x-icon name="arrow" />
    </a>
</div>
