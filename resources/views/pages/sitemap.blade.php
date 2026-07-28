<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($staticPages as $key => $staticPage)
        <url>
            <loc>{{ route($key) }}</loc>
            <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
    @foreach ($promotions as $promotion)
        <url>
            <loc>{{ route('promotion.index', $promotion->finalSlug()) }}</loc>
            <lastmod>
                {{ $promotion->created_at ? $promotion->created_at->tz('UTC')->toAtomString() : now()->tz('UTC')->toAtomString() }}
            </lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
    @foreach ($categories as $category)
        <url>
            <loc>{{ route('category.index', ['categorySlug' => $category->slug]) }}</loc>
            <lastmod>
                {{ $category->created_at ? $category->created_at->tz('UTC')->toAtomString() : now()->tz('UTC')->toAtomString() }}
            </lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
        @foreach ($category->products as $product)
            @if ($product->is_active)
                <url>
                    <loc>
                        {{ route('product.detail', ['categorySlug' => $category->slug, 'productSlug' => $product->slug]) }}
                    </loc>
                    <lastmod>
                        {{ $product->created_at ? $product->created_at->tz('UTC')->toAtomString() : now()->tz('UTC')->toAtomString() }}
                    </lastmod>
                    <changefreq>weekly</changefreq>
                    <priority>0.9</priority>
                </url>
            @endif
        @endforeach
    @endforeach
</urlset>
