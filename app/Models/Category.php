<?php

namespace App\Models;

use App\Utils\ProcessData;
use App\Models\Interface\HasSeo as InterfaceHasSeo;
use App\Models\Traits\HasSeo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

class Category extends Model implements InterfaceHasSeo
{
    use HasFactory;
    use HasSeo;

    protected $schema_type = 'Category';

    protected $fillable = [
        'image',
        'name',
        'slug',
        'menu',
        'is_active',
        'description'
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getAllActive()
    {
        $cacheKey = "category_all_active";
        return Cache::rememberForever($cacheKey, function () {
            return $this->where('is_active', true)->get();
        });
    }

    public function getByCategorySlug(string $slug)
    {
        $cacheKey = "category_type_name_{$slug}";
        return Cache::rememberForever($cacheKey, function () use ($slug) {
            return $this->where('is_active', true)
                ->where('slug', $slug)
                ->firstOrFail();
        });
    }

    public function getAllToSiteMap()
    {
        $cacheKey = "category_all_to_site_map";
        return Cache::rememberForever($cacheKey, function () {
            return $this->where('is_active', true)
                ->with(['products', 'seoData'])
                ->get();
        });
    }

    public function search(?string $search): array
    {
        $currentPage = Request::get('page', 1);
        $normalized = ProcessData::normalizeSearch($search);
        $cacheKey = 'search_category_' . md5($normalized) . $currentPage;
        return Cache::remember($cacheKey, now()->addHours(2), function () use ($normalized) {
            return $this->where('is_active', true)
                ->whereRaw(
                    'LOWER(name) LIKE ?',
                    ['%' . $normalized . '%']
                )
                ->pluck('id')
                ->toArray();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function seoData()
    {
        return $this->morphOne(SeoData::class, 'seoable');
    }

    public function finalRoute()
    {
        $currentPage = Request::get('page', 1);
        return route('category.index', ['categorySlug' => $this->slug]) . '?page=' . $currentPage;
    }
}
