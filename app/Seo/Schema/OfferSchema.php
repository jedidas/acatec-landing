<?php

namespace App\Seo\Schema;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class OfferSchema
{
    public function __construct(
        private $model,
        private string $image,
    ) {}

    public function toArray(): array
    {
        $validFrom = $this->model->valid_from
            ? Carbon::parse($this->model->valid_from)->toIso8601String()
            : null;

        $validThrough = $this->model->valid_until
            ? Carbon::parse($this->model->valid_until)->toIso8601String()
            : null;

        // Seller
        $seller = [
            '@type' => 'Organization',
            'name' => config('settings.site_name')
        ];

        $price = $this->model->price ?? null;

        if ($price && $this->model->discount) {
            $price = round(
                $price - ($price * $this->model->discount / 100),
                2
            );
        }

        $data = [
            '@context' => 'https://schema.org',
            '@type' => 'Offer',
            'name' => $this->model->seoTitle(),
            'description' => $this->model->seoDescription(),
            'keywords' => $this->model->focusKeyword(),
            'url' => route('promotion.index', ['slug' => $this->model->canonicalUrl()]),
            'image' => asset($this->image),
            'availability' => 'https://schema.org/InStock',
            'seller' => $seller,
        ];

        if (isset($validFrom) && isset($validThrough)) {
            $data['validFrom'] = $validFrom;
            $data['validThrough'] = $validThrough;
        }

        if ($price) {
            $data['price'] = number_format($price, 2, '.', '');
            $data['priceCurrency'] = $this->model->currency ?? 'CRC';
        }

        return $data;
    }
}
