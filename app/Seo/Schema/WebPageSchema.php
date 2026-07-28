<?php

namespace App\Seo\Schema;

use Illuminate\Support\Facades\App;

class WebPageSchema
{
    public function __construct(
        private $model,
        private string $image,
    ) {}

    public function toArray(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => $this->model->seoTitle(),
            'description' => $this->model->seoDescription(),
            'url' => route('promotion.index', ['slug' => $this->model->canonicalUrl()]),
            'image' => asset($this->image),
            'keywords' => $this->model->focusKeyword(),
        ];
    }
}
