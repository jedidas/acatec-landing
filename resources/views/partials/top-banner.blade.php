<section class="top-banner swiper swiper-container @if ($banners->count()) banner-slider @endif">
    <div class="swiper-wrapper h-auto!">
        @forelse ($banners as $banner)
            <div class="swiper-slide">
                @if ($banner->link)
                    <a href="{{ $banner->link }}" target="{{ $banner->target }}" class="block">
                        <picture class="block">
                            <img src="{{ asset('images/banners/banner-empty.png') }}"
                                data-src="{{ asset('storage/' . $banner->image) }}"
                                loading="lazy block w-full object-fill" class="lazy block w-full"
                                alt="banners-{{ $loop->index }}" />
                        </picture>
                    </a>
                @else
                    <picture class="block w-full">
                        <source media="(max-width: 767px)" data-srcset="{{ asset('storage/' . $banner->mobile) }}">
                        <source media="(min-width: 768px)" data-srcset="{{ asset('storage/' . $banner->image) }}">
                        <img src="{{ asset('images/banners/banner-empty.png') }}"
                            data-src="{{ asset('storage/' . $banner->image) }}" alt="banner-{{ $loop->index }}"
                            class="lazy w-full h-auto object-cover aspect-square md:aspect-16/6" width="1920"
                            height="720">
                    </picture>
                @endif
            </div>

        @empty
            <div class="swiper-slide">
                <picture class="block w-full">
                    <source media="(max-width: 767px)" data-srcset="{{ asset('images/banners/banner-mobile.jpg') }}">
                    <source media="(min-width: 768px)" data-srcset="{{ asset('images/banners/banner.jpg') }}">
                    <img src="{{ asset('images/banners/banner-empty.png') }}"
                        data-src="{{ asset('images/banners/banner-mobile.jpg') }}" loading="lazy" alt="banner"
                        class="lazy w-full h-auto object-cover aspect-square md:aspect-16/6" width="1920"
                        height="720">
                </picture>
            </div>
        @endforelse
    </div>
    @if ($banners->count() > 1)
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    @endif
</section>
