<div {{ $attributes->merge(['class' => 'flex gap-3 items-center']) }}>
    @if ($attributes->has('icon'))
        <x-icon name="{{ $attributes->get('icon') }}" class="h-6 w-6" />
    @endif

    <h2 @class([
        'flex flex-col ',
        $attributes->has('text-color')
            ? $attributes->get('text-color')
            : 'text-black',
    ])>
        <span class="block text-xl font-black">{{ $slot }}</span>
        <span @class([
            'block ',
            $attributes->has('color-sub-heading')
                ? $attributes->get('color-sub-heading')
                : 'text-gray-500 ',
        ])>
            {{ $attributes->has('sub-heading') ? $attributes->get('sub-heading') : config('settings.title_legend') }}
        </span>
    </h2>
</div>
