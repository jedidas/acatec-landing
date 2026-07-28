<div class="flex flex-col bg-white shadow-gray-800/50 shadow-lg border">
    <a class="block relative group"
        href="{{ route('product.detail', ['categorySlug' => $product->category->slug, 'productSlug' => $product->slug]) }}">
        @if (isset($showCategory))
            <p class="top-[10%] left-0 z-10 absolute bg-gray-900 p-3 font-medium text-white text-sm">
                {{ $product->category->name }}
            </p>
        @endif
        <picture class="spinner-picture block overflow-hidden aspect-4/3">
            <img data-src="{{ asset('storage/' . $product->image) }}"
                src="{{ asset('images/products/empty-products.png') }}"
                class="lazy block w-full group-hover:transform transition-all group-hover:scale-110 aspect-4/3"
                alt="{{ $product->name }}">
        </picture>
    </a>
    <article class="flex flex-col justify-between">
        <div class="p-3">
            <p>
                <a href="{{ route('category.index', ['categorySlug' => $product->category->slug]) }}">
                    <small>{{ $product->category->name }}</small>
                </a>
            </p>
            <h4 class="mb-2 font-bold min-h-16 lg:min-h-20 text-lg lg:text-xl">
                {{ $product->name }}
            </h4>
            <div class="flex flex-col -mr-3 min-h-14 justify-center">
                <div class="flex justify-end items-center gap-3">
                    @if ($product->has_price && $product->final_price > 0)
                        <div class="text-right flex flex-col gap-0">
                            <p class="font-bold text-xl">
                                {{ env('CURRENCY') }}{{ number_format($product->final_price, 0) }}
                            </p>
                            @if ($product->discount)
                                <p class="font-medium text-base line-through">
                                    {{ env('CURRENCY') }}{{ number_format($product->price, 0) }}
                                </p>
                            @endif
                        </div>
                    @endif
                    @if ($product->discount)
                        <span
                            class="flex justify-center items-center bg-gray-300 p-1 w-12 h-12 font-bold text-gray-700 text-lg">
                            {{ $product->discount }}%
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="flex">
            <a class="block bg-amber-700 hover:bg-red px-5 py-2.5 border border-none w-full text-white focus:outline-none focus:ring-4 focus:ring-gray-100 font-bold text-center text-lg"
                href="{{ route('product.detail', ['categorySlug' => $product->category->slug, 'productSlug' => $product->slug]) }}">
                {{ __('Detalle') }}
            </a>
        </div>
    </article>
</div>
