<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\Promotion;


class SiteMapController extends Controller
{
    public function __construct(public Category $category, public Product $product, public Promotion $promotion) {}

    public function index()
    {
        $staticPages = Page::STATIC_PAGES;
        $categories = $this->category->getAllToSiteMap();
        $promotions = $this->promotion->getAll();

        return response()->view('pages.sitemap', compact('categories', 'promotions', 'staticPages'))->header('Content-Type', 'text/xml');
    }

    public function manifest()
    {
        $data = Cache::rememberForever(
            "manifest",
            function () {
                return [
                    "short_name" => config('settings.site_name'),
                    "name" => config('settings.site_name'),
                    "lang" => app()->getLocale(),
                    "description" => config('settings.og_description'),
                    "start_url" => url('/'),
                    "background_color" => config('settings.theme_color', '#238dbe'),
                    "theme_color" => config('settings.theme_color', '#238dbe'),
                    "dir" => "ltr",
                    "display" => "standalone",
                    "orientation" => "portrait",
                    "prefer_related_applications" => false,
                    "icons" => [
                        [
                            "src" => asset('android-icon-36x36.png'),
                            "sizes" => "36x36",
                            "type" => "image/png",
                            "density" => "0.75",
                        ],
                        [
                            "src" => asset('android-icon-48x48.png'),
                            "sizes" => "48x48",
                            "type" => "image/png",
                            "density" => "1.0",
                        ],
                        [
                            "src" => asset('android-icon-72x72.png'),
                            "sizes" => "72x72",
                            "type" => "image/png",
                            "density" => "1.5",
                        ],
                        [
                            "src" => asset('android-icon-96x96.png'),
                            "sizes" => "96x96",
                            "type" => "image/png",
                            "density" => "2.0",
                        ],
                        [
                            "src" => asset('android-icon-144x144.png'),
                            "sizes" => "144x144",
                            "type" => "image/png",
                            "density" => "3.0",
                        ],
                        [
                            "src" => asset('android-icon-192x192.png'),
                            "sizes" => "192x192",
                            "type" => "image/png",
                            "density" => "4.0",
                        ],
                    ],
                ];
            }
        );

        return response()
            ->json($data)
            ->header('Content-Type', 'application/manifest+json')
            ->header('Cache-Control', 'public, max-age=86400');
    }
}
