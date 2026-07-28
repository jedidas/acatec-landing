<?php

namespace App\Models;

use App\Models\Traits\HasSeo;
use App\Models\Interface\HasSeo as InterfaceHasSeo;

use App\Utils\ProcessData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

class Product extends Model implements InterfaceHasSeo
{
    use HasFactory;
    use HasSeo;

    protected $schema_type = 'ProductSchemaFinal';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'image',
        'price',
        'discount',
        'code',
        'has_price',
        'description',
        'features',
        'is_active',
        'is_featured',
        'added_on'
    ];

    protected function casts(): array
    {
        return [
            'has_price' => 'boolean',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'added_on' => 'datetime:Y-m-d',
            'features' => 'array',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function searchByCategoryId(int $categoryId, string $orderBy = '')
    {
        $currentPage = Request::integer('page', 1);
        $cacheKey = "product_{$categoryId}_all_{$currentPage}_{$orderBy}";

        return Cache::remember($cacheKey, now()->addHours(2), function () use ($categoryId, $orderBy) {
            $query = $this->where('is_active', true)
                ->where('category_id', $categoryId)
                ->with(['category', 'images']);
            match ($orderBy) {
                'high_price' => $query->orderByRaw('(price - (price * discount / 100)) DESC'),
                'low_price' => $query->orderByRaw('(price - (price * discount / 100)) ASC'),
                'ascending_name' => $query->orderBy('name'),
                'descending_name' => $query->orderByDesc('name'),
                default => $query->latest(),
            };
            return $query->paginate(config('settings.items_per_page'));
        });
    }

    public function getAllByCategoryId(int $categoryId)
    {
        $currentPage = Request::get('page', 1);
        $cacheKey = "product_{$categoryId}_all_{$currentPage}";
        return Cache::rememberForever($cacheKey, function () use ($categoryId) {
            return $this->where('is_active', true)
                ->where('category_id', $categoryId)
                ->with(['category', 'images'])
                ->paginate(config('settings.items_per_page'));
        });
    }

    public function getDetailByCategoryIdAndSlug(int $categoryId, string $slug)
    {
        $cacheKey = "product_{$categoryId}_slug_{$slug}";
        return Cache::rememberForever($cacheKey, function () use ($categoryId, $slug) {
            return $this->where('is_active', true)
                ->where('category_id', $categoryId)
                ->where('slug', $slug)
                ->with(['category', 'images'])
                ->firstOrFail();
        });
    }

    public function getSomeFromEachCategory()
    {
        $cacheKey = "product_some_from_each_category";
        return Cache::rememberForever($cacheKey, function () {
            return $this->where('is_active', 1)
                ->where('is_featured', 0)
                ->orderBy('added_on')
                ->groupLimit(1, 'category_id')
                ->with(['category', 'images'])
                ->get();
        });
    }

    public function getFeatured(?int $count = 20)
    {
        $cacheKey = "featured_product_{$count}";
        return Cache::rememberForever($cacheKey, function () use ($count) {
            return $this->where('is_active', 1)
                ->where('is_featured', 1)
                ->orderBy('added_on')
                ->take($count)
                ->with(['category', 'images'])
                ->get();
        });
    }

    public function search(?string $search, array $categoriesIds)
    {
        $currentPage = Request::get('page', 1);
        $normalized = ProcessData::normalizeSearch($search);
        $cacheKey = 'search_product_' . md5($normalized) . $currentPage;

        return Cache::rememberForever($cacheKey, function () use ($categoriesIds, $normalized) {
            return $this->where('is_active', true)
                ->where(function ($query) use ($normalized, $categoriesIds) {
                    $query->whereRaw(
                        'LOWER(name) LIKE ?',
                        ['%' . $normalized . '%']
                    )
                        ->orWhereRaw(
                            'LOWER(description) LIKE ?',
                            ['%' . $normalized . '%']
                        )
                        ->orWhereIn('category_id', $categoriesIds);
                })
                ->with(['category', 'images'])
                ->paginate(config('settings.items_per_page'));
        });
    }

    public function getRelatedById(int $id, int $categoryId, ?int $count = 20)
    {
        $cacheKey = "product_related_{$id}_category_{$categoryId}_count_{$count}";
        return Cache::rememberForever($cacheKey, function () use ($id, $categoryId, $count) {
            return $this->where('is_active', 1)
                ->where('is_featured', 0)
                ->where('category_id', $categoryId)
                ->whereNot('id', $id)
                ->take($count)
                ->with(['category', 'images'])
                ->get();
        });
    }

    public function getArrayByArrayObjects(array $array)
    {
        $processData = new ProcessData();
        $arrayIds = $processData->extractValuesByKey(array: $array, key: 'id');
        $cacheKey = "product_array_objects_" . md5(implode('_', $arrayIds));

        return Cache::rememberForever($cacheKey, function () use ($arrayIds, $array) {
            $result = $this->whereIn('id', $arrayIds)->with(['category'])->get();
            $result = $result->map(function ($item) use ($array) {
                foreach ($array as $value) {
                    $item->makeHidden(['created_at', 'is_active', 'description', 'is_featured', 'updated_at', 'added_on']);

                    $item->url = route('product.detail', [
                        'categorySlug' => $item->category->slug,
                        'productSlug' => $item->slug,
                    ]);

                    $item->final_price = $item->final_price;

                    if ($item->id == $value['id']) {
                        $item->quantity = intval($value['quantity']);
                    }

                    $item->makeHidden(['category']);
                }
                return $item;
            });

            return $result->toArray();
        });
    }

    public function getAllByArrayIds(array $arrayIds)
    {
        sort($arrayIds);
        $cacheKey = 'products_' . implode('_', $arrayIds);

        return Cache::rememberForever($cacheKey, function () use ($arrayIds) {
            return $this->where('is_active', 1)
                ->whereIn('id', $arrayIds)
                ->with(['category', 'images'])
                ->get();
        });
    }


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    protected function finalPrice(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->price - ($this->price / 100 * $this->discount),
        );
    }



    public function seoData()
    {
        return $this->morphOne(SeoData::class, 'seoable');
    }

    public function finalRoute()
    {
        $currentPage = Request::get('page', 1);
        return route('product.detail', ['categorySlug' => $this->category->slug, 'productSlug' => $this->slug]) . '?page=' . $currentPage;
    }
}
