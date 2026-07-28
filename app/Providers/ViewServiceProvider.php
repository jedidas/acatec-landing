<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(
            [
                'partials.top-banner',
            ],
            'App\Http\ViewComposers\BannerViewComposer'
        );

        View::composer(
            [
                'partials.main-menu',
            ],
            'App\Http\ViewComposers\MenuViewComposer'
        );

        View::composer(
            [
                'partials.featured-products',
                'partials.featured-slider-products',
            ],
            'App\Http\ViewComposers\FeaturedProductsViewComposer'
        );
    }
}
