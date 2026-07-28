<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Banner extends Model
{

    protected $fillable = [
        'image',
        'mobile',
        'target',
        'link',
        'is_active',
    ];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getActive()
    {
        return Cache::rememberForever('banners', function () {
            return $this->where('is_active', 1)->get();
        });
    }
}
