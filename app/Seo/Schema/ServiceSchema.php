<?php

namespace App\Seo\Schema;

use Illuminate\Support\Facades\App;

class ServiceSchema
{
    public function __construct(
        private $model,
        private string $image,
    ) {}

    public function toArray(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $this->model->seoTitle(),
            'description' => $this->model->seoDescription(),
            'keywords' => $this->model->focusKeyword(),
            'url' => route('promotion.index', ['slug' => $this->model->canonicalUrl()]),
            'url' => route('promotion.index', ['slug' => $this->model->canonicalUrl()]),
            'image' => asset($this->image),
            'provider' => [
                '@type' => 'Organization',
                'name' => config('settings.site_name'),
            ],
        ];
    }
}
