<?php

namespace App\Models;

use App\Events\QuotationCreated;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'products',
        'added_on',
        'is_active',
    ];

    protected $appends = [
        'total',
        'data_json'
    ];

    protected $casts = [
        'products' => 'array',
    ];

    protected $dispatchesEvents = [
        'created' => QuotationCreated::class,
    ];

    public function getDataJsonAttribute(): array
    {
        $products = $this->products;

        if (is_string($products)) {
            $products = json_decode($products, true);
        }

        return collect($products ?? [])
            ->map(function ($product) {

                if (!is_array($product)) {
                    return [];
                }

                $product['total'] =
                    ($product['final_price'] ?? 0) *
                    ($product['quantity'] ?? 0);

                return $product;
            })
            ->values()
            ->all();
    }

    public function getTotalAttribute()
    {
        return collect($this->products ?? [])->sum(fn($p) => ($p['final_price'] ?? 0) * ($p['quantity'] ?? 0));
    }
}
