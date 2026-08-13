<div
    {{ $attributes->merge([
        'class' => 'title-container flex gap-3 items-center ' . $attributes->get('variant'),
    ]) }}>
    @if ($attributes->has('icon'))
        <div class="relative title-icon-box">
            <div class="title-icon flex items-center justify-center h-11 w-11">
                <x-icon name="{{ $attributes->get('icon') }}" class="h-7 w-7" />
            </div>
        </div>
    @endif

    <h2 class="flex flex-col gap-1 text-text text-xl">
        <span class="block text-base lg:text-4xl font-black">{{ $slot }}</span>
        <hr>
        <span class="block font-light text-base sub-heading">
            {{ $attributes->has('sub-heading') ? $attributes->get('sub-heading') : config('settings.title_legend') }}
        </span>
    </h2>
</div>
