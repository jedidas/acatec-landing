<div class="products-by-category">
    <div class="mb-5">
        @if ($products->count())
            <ul class="gap-5 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
                @foreach ($products as $product)
                    <li>
                        @include('partials.product-item', [
                            'categoryName' => $product->category->slug,
                            'product' => $product,
                        ])
                    </li>
                @endforeach
            </ul>
        @else
            <h3 class="p-4 text-center text-2xl font-bold">{{ __('Sin productos disponibles') }}</h3>
        @endif
    </div>
    <div class="products-by-pagination flex mb-5">
        {{ $products->links('pagination::tailwind') }}
    </div>
</div>
