<?php

namespace App\Seo\Schema;

use Carbon\Carbon;

class ProductSchemaFinal
{
    public function __construct(
        private $model,
        private string $image,
    ) {}

    public function toArray(): array
    {
        $price = $this->model->seoData->price ?? null;

        $data = [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $this->model->seoTitle(),
            'description' => $this->model->seoDescription(),
            'keywords' => $this->model->focusKeyword(),
            'url' => route('product.detail', [
                'categorySlug' =>  $this->model->category->slug,
                'productSlug' => $this->model->canonicalUrl()
            ]),
            'availability' => 'https://schema.org/InStock',
            'sku' => $this->model->canonicalUrl(),
            'image' => asset($this->image),
            'brand' => [
                '@type' => 'Brand',
                'name' => config('settings.site_name'),
            ],
            'seller' => [
                '@type' => 'Organization',
                'name' => config('settings.site_name'),
            ],
            'validFrom' => $this->model->valid_from ? Carbon::parse($this->model->valid_from)->toIso8601String() : null,
            'priceValidUntil' => $this->model->valid_until
                ? Carbon::parse($this->model->valid_until)->toIso8601String()
                : Carbon::parse($this->model->added_on)->addMonth()->toIso8601String(),
        ];

        if ($price) {
            $data['price'] = number_format($price, 2, '.', '');
            $data['priceCurrency'] = $this->model->currency ?? 'CRC';
        }

        return $data;
    }
}
