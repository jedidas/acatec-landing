<?php

namespace App\Models;

use App\Models\Interface\HasSeo as InterfaceHasSeo;
use App\Models\Traits\HasSeo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Promotion extends Model implements InterfaceHasSeo
{
    use HasFactory;
    use HasSeo;

    protected string $schema_type = 'Offer';

    protected $fillable = [
        'name',
        'slug',
        'image',
        'content',
        'added_on',
        'updated_on',
        'is_active'
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:Y-m-d',
            'updated_at' => 'datetime:Y-m-d',
            'added_on' => 'datetime:Y-m-d',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function seoData()
    {
        return $this->morphOne(SeoData::class, 'seoable');
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getBySlug(string $slug)
    {
        $promotion = Cache::rememberForever(
            "promotions_get_by_slug_{$slug}",
            function () use ($slug) {
                return $this->newQuery()
                    ->where('is_active', true)
                    ->where(function ($q) use ($slug) {
                        $q->where('slug', $slug)
                            ->orWhereHas('seoData', function ($q2) use ($slug) {
                                $q2->where('seo_canonical', $slug);
                            });
                    })
                    ->with('seoData')
                    ->first();
            }
        );

        if (!$promotion) {
            abort(404);
        }

        // SEO GUARD
        $canonicalSlug = $promotion?->seoData?->seo_canonical;
        if (!empty($canonicalSlug)) {
            if ($slug !== $canonicalSlug) {
                abort(404);
            }
        }

        return $promotion;
    }

    public function getAll()
    {
        return  Cache::rememberForever(
            "promotions_get_all",
            function () {
                return  $this->where('is_active', true)->with('seoData')->get();
            }
        );
    }

    public function finalRoute()
    {
        return route('promotion.index', ['slug' => $this->finalSlug()]);
    }
}
