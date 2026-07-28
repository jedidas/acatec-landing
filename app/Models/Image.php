<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Image extends Model
{
    protected $fillable = [
        'product_id',
        'image',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getAllByProductId(int $productId)
    {
        $cacheKey = "Images_{$productId}";
        return Cache::rememberForever($cacheKey, function () use ($productId) {
            return  $this->where('product_id', $productId)->get();
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
