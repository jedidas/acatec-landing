<?php

namespace App\Models\Traits;

use App\Seo\SeoData as SeoDto;
use App\Seo\Schema\SchemaFactory;

use Illuminate\Support\Str;

trait HasSeo
{
    public function seo(): SeoDto
    {
        return new SeoDto(
            title: $this->getSeoTitle(),
            description: $this->getSeoDescription(),
            canonical: $this->getCanonicalUrl(),
            robots: $this->getRobotsMeta(),
            og: $this->getOgData(),
            twitter: $this->getTwitterData(),
            schema: SchemaFactory::make($this, $this->schema_type, $this->finalImage()),
        );
    }

    protected function seoDataModel()
    {
        return $this->seoData; // morphOne
    }

    protected function getSeoTitle(): string
    {
        return
            $this->seoDataModel()?->seo_title
            ?? $this->name
            ?? config('settings.site_name');
    }

    protected function getSeoDescription(): string
    {
        return $this->seoDataModel()?->seo_description
            ?? Str::limit(strip_tags($this->content ?? ''), 155);
    }

    protected function getFocusKeyword(): string
    {
        return $this->seoDataModel()?->focus_keyword ?? '';
    }

    protected function getCanonicalUrl(): string
    {
        return $this->getFinalSlug();
    }

    protected function getCanonicalSlug(): string
    {
        if (!empty($this->seo_canonical)) {
            return $this->seo_canonical;
        }

        return
            $this->seoDataModel()?->seo_canonical
            ?? $this->getUrl();
    }

    protected function getRobotsMeta(): string
    {
        $seo = $this->seoDataModel();

        return implode(', ', [
            ($seo?->seo_noindex ?? false) ? 'noindex' : 'index',
            ($seo?->seo_nofollow ?? false) ? 'nofollow' : 'follow',
        ]);
    }

    public function shouldNoIndex(): bool
    {
        return (bool) $this->seo_noindex;
    }

    public function shouldNoFollow(): bool
    {
        return (bool) $this->seo_nofollow;
    }

    protected function getOgData(): array
    {
        $defaultImage = isset($this->image) ? $this->image : 'images/social/social.jpg';

        return [
            'title'       => $this->seoDataModel()?->og_title ?? $this->getSeoTitle(),
            'description' => $this->seoDataModel()?->og_description ?? $this->getSeoDescription(),
            'image'       => $this->seoDataModel()?->og_image ?? $defaultImage,
            'url'         => $this->getCanonicalUrl(),
        ];
    }

    protected function getTwitterData(): array
    {
        return [
            'title'       => $this->seoDataModel()?->twitter_title ?? $this->getOgData()['title'],
            'description' => $this->seoDataModel()?->twitter_description ?? $this->getOgData()['description'],
            'image'       => $this->seoDataModel()?->twitter_image ?? $this->getOgData()['image'],
        ];
    }

    protected function getFinalSlug(): string
    {
        $seoCanonical = $this->seoDataModel()?->seo_canonical;
        if (!empty($seoCanonical)) {
            return $seoCanonical;
        }
        return $this->slug;
    }

    protected function getFinalImage(): string
    {
        $baseUrl = rtrim(config('app.url'), '/') . '/storage/';

        // Imagen SEO (og_image) tiene prioridad
        $image = $this->seoDataModel()?->og_image;
        if ($image !== null) {
            $imagePath = str_replace($baseUrl, '', $image);
            return 'storage/' . $imagePath;
        }

        if ($this->image === null) {
            return 'images/social/social.jpg';
        }

        $imagePath = str_replace($baseUrl, '', $this->image);
        return 'storage/' . $imagePath;
    }

    public function getUrl(): string
    {
        // ← CORREGIDO: antes era "$this->slug ?? $this->slug ?? null" (redundante)
        $slug = $this->slug ?? null;

        if (!$slug) {
            throw new \RuntimeException(
                'Slug no definido para el modelo ' . class_basename($this)  // ← mensaje genérico, no solo "promoción"
            );
        }

        return $slug;
    }

    public function seoTitle(): string
    {
        return $this->getSeoTitle();
    }

    public function seoDescription(): string
    {
        return $this->getSeoDescription();
    }

    public function focusKeyword(): string
    {
        return $this->getFocusKeyword();
    }

    public function canonicalUrl(): string
    {
        return $this->getCanonicalUrl();
    }

    public function canonicaSlug(): string
    {
        return $this->getCanonicalSlug();
    }

    public function finalSlug(): string
    {
        return $this->getFinalSlug();
    }

    public function finalImage(): string
    {
        return $this->getFinalImage();
    }
}
