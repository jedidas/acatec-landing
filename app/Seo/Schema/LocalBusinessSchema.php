<?php

namespace App\Seo\Schema;

use Illuminate\Support\Facades\App;

class LocalBusinessSchema
{
    public function __construct(
        private $model,
        private string $image,
    ) {}

    public function toArray(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => config('settings.site_name'),
            'url' => route('promotion.index', ['slug' => $this->model->canonicalUrl()]),
            'url' => route('promotion.index', ['slug' => $this->model->canonicalUrl()]),
            'image' => asset($this->image),
            'description' => $this->model->seoDescription(),
            'keywords' => $this->model->focusKeyword(),
        ];
    }
}
