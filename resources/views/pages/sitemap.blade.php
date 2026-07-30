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
</urlset>
