<?php

namespace App\Models;

use App\Models\Interface\HasSeo as InterfaceHasSeo;
use App\Models\Traits\HasSeo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Cache;

class Page extends Model implements InterfaceHasSeo
{
    use HasFactory;
    use HasSeo;

    protected $fillable = ['image', 'slug', 'name'];
    protected string $schema_type = 'StaticWebPage';

    public const STATIC_PAGES = [
        'home.index' => 'Inicio',
        'about.index' => 'Nosotros',
        'policies.index' => 'Políticas',
    ];

    public function seoData(): MorphOne
    {
        return $this->morphOne(SeoData::class, 'seoable');
    }

    public function finalRoute(): string
    {
        $routeName = self::STATIC_PAGES[$this->slug] ?? null;

        abort_if(!$routeName, 404);

        return route($this->slug);
    }

    public function getBySeoSlug(string $slug)
    {
        $cacheKey = "Page_name_{$slug}";
        return Cache::rememberForever($cacheKey, function () use ($slug) {
            return    $this->where('slug', $slug)->with('seoData')->firstOrFail();
        });
    }

    protected static function booted()
    {
        static::created(function ($page) {
            $page->seoData()->create();
        });
    }
}
