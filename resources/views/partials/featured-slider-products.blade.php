<div class="w-full">
    @if ($products->count())
        <section class="featured-slider swiper swiper-container">
            <div class="swiper-wrapper h-auto!">
                @foreach ($products as $product)
                    <div class="swiper-slide">
                        @include('partials.product-item', [
                            'categoryName' => $product->category->slug,
                            'product' => $product,
                        ])
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </section>
    @else
        <h3 class="p-4 text-center text-2xl font-bold">{{ __('Sin productos disponibles') }}</h3>
    @endif
</div>
