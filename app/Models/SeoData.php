<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class SeoData extends Model
{
    protected $table = 'seo_data';

    /**
     * Mass assignment
     */
    protected $fillable = [
        // Polimórfica
        'seoable_id',
        'seoable_type',

        // SEO
        'seo_title',
        'seo_description',
        'seo_canonical',
        'seo_noindex',
        'seo_nofollow',
        'seo_json',

        // Open Graph
        'og_title',
        'og_description',
        'og_image',
        'og_alt_image',

        // Twitter
        'twitter_title',
        'twitter_description',
        'twitter_image',

        // Fechas
        'valid_from',
        'valid_until',

        // Schema
        'schema_type',
        'focus_keyword',
        'price',
        'discount',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'seo_noindex' => 'boolean',
        'seo_nofollow' => 'boolean',

        'valid_from'  => 'datetime',
        'valid_until' => 'datetime',
    ];

    /**
     * Relación polimórfica
     */
    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * 🔎 Scope: SEO válido por fecha
     */
    public function scopeValid($query)
    {
        return $query
            ->where(function ($q) {
                $q->whereNull('valid_from')
                    ->orWhere('valid_from', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('valid_until')
                    ->orWhere('valid_until', '>=', now());
            });
    }

    /**
     * 🧠 Helpers
     */
    public function title(string $locale, ?string $fallback = null): ?string
    {
        return $this->seo_title[$locale]
            ?? $fallback
            ?? null;
    }

    public function description(string $locale, ?string $fallback = null): ?string
    {
        return $this->seo_description[$locale]
            ?? $fallback
            ?? null;
    }

    public function canonical(string $locale): string
    {
        return $this->seo_canonical[$locale]
            ?? url()->current();
    }

    /**
     * 🤖 Robots meta
     */
    public function robots(): string
    {
        return implode(',', [
            $this->seo_noindex ? 'noindex' : 'index',
            $this->seo_nofollow ? 'nofollow' : 'follow',
        ]);
    }

    /**
     * 🧩 OG helpers
     */
    public function ogTitle(string $locale, ?string $fallback = null): ?string
    {
        return $this->og_title[$locale]
            ?? $this->title($locale, $fallback);
    }

    public function ogDescription(string $locale, ?string $fallback = null): ?string
    {
        return $this->og_description[$locale]
            ?? $this->description($locale, $fallback);
    }

    /**
     * 🐦 Twitter helpers
     */
    public function twitterTitle(string $locale, ?string $fallback = null): ?string
    {
        return $this->twitter_title[$locale]
            ?? $this->title($locale, $fallback);
    }

    public function twitterDescription(string $locale, ?string $fallback = null): ?string
    {
        return $this->twitter_description[$locale]
            ?? $this->description($locale, $fallback);
    }

    /**
     * 🟢 Check SEO activo
     */
    public function isActive(): bool
    {
        return $this->valid_from <= now() && (
            $this->valid_until === null || $this->valid_until >= now()
        );
    }
}
