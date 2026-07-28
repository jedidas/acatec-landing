<?php

namespace App\Seo\Schema;

class StaticWebPageSchema
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
            'url' => route($this->model->slug),
            'inLanguage' => 'es-CR',
            'keywords' => $this->model->focusKeyword(),
            'isPartOf' => [
                '@type' => 'WebSite',
                '@id' => url('/') . '#website',
                'name' => config('settings.site_name'),
                'url' => url('/'),
            ],
            'primaryImageOfPage' => [
                '@type' => 'ImageObject',
                'url' => asset($this->image),
            ],
            'publisher' => [
                '@type' => 'Organization',
                '@id' => url('/') . '#organization',
                'name' => config('settings.site_name'),
                'url' => url('/'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/logos/logotype.svg'),
                ],
            ],
            'datePublished' => optional($this->model->created_at)?->toIso8601String(),
            'dateModified' => optional($this->model->updated_at)?->toIso8601String(),
        ];
    }
}
