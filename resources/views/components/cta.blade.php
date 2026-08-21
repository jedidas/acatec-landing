<div {{ $attributes->merge([
    'class' => 'cta-component flex mb-10 ' . $attributes->get('variant'),
]) }}>
    <a href="{{ $attributes->has('href') ? $attributes->get('href') : '#' }}" data-href="contacto"
        class="wd-scroll flex items-center border-6 md:border-10 relative p-2! pr-1.5! pl-3! pt-3! md:p-3! md:pl-5! md:pt-5! justify-center gap-1.5 uppercase font-bold transition duration-200 text-sm lg:text-base xl:text-lg">
        {{ $slot }}
        <x-icon name="arrow" class="h-3 w-3 md:h-4 md:w-4" />
    </a>
</div>
