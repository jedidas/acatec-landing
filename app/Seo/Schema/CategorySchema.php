<?php

namespace App\Seo\Schema;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Cache;

use App\Models\Product;

class CategorySchema
{
    public function __construct(
        private $category,
        private string $image,
    ) {}

    public function toArray(): array
    {
        $itemList = [];
        $position = 1;

        $currentPage = Request::get('page', 1);
        $cacheKey = "category_schema_" . $this->category->slug . '_' . $currentPage;

        $products = Cache::rememberForever($cacheKey, function () use ($currentPage) {
            $productModel = new Product;
            return $productModel->where('is_active', true)
                ->where('category_id', $this->category->id)
                ->paginate(12, ['*'], 'page', $currentPage);
        });

        foreach ($products as $product) {
            $itemList[] = [
                '@type' => 'ListItem',
                'position' => $position++,
                'url' => route('product.detail', [
                    'categorySlug' => $this->category->slug,
                    'productSlug'   => $product->slug,
                ]),

                'image' => asset('storage/' . $product->image),
                'item' => [
                    '@type' => 'Product',
                    'name'  => $product->name,
                    'image' => asset('storage/' . $product->image),
                    'offers' => [
                        '@type' => 'Offer',
                        'price' => number_format(
                            $product->price * (1 - ($product->discount ?? 0) / 100),
                            2,
                            '.',
                            ''
                        ),
                        'priceCurrency' => 'CRC',
                        'availability'  => 'https://schema.org/InStock',
                    ],
                ],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type'    => 'CollectionPage',

            'name' => $this->category->seoTitle(),
            'description' => $this->category->seoDescription(),

            'keywords' => $this->category->focusKeyword(),

            'image' => asset($this->image),

            'url' => route('category.index', [
                'categorySlug'   => $this->category->slug,
            ]) . '?page=' . $currentPage,

            'mainEntity' => [
                '@type' => 'ItemList',
                'numberOfItems' => count($itemList),
                'itemListOrder' => 'https://schema.org/ItemListOrderAscending',
                'itemListElement' => $itemList,
            ],
        ];
    }
}
