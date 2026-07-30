<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\SiteMapController;
use Illuminate\Support\Facades\Route;


Route::get('sitemap.xml', [SiteMapController::class, 'index'])->name('sitemap.index');
Route::get("manifest.json", [SiteMapController::class, "manifest"])->name("manifest.index");
Route::get("cache-clear", [MainController::class, "cacheClear"])
    ->middleware(['auth'])
    ->name("cache-clear.index");

Route::prefix("api")->group(function () {
    Route::post("contact/send", [EmailController::class, "contact"])->name("api.contact");
});

Route::get("/", [MainController::class, "home"])->name("home.index");
Route::get('promociones/{slug}', [PromotionController::class, 'detail'])->name('promotion.index');

// Route::post("quote/send", [EmailController::class, "sendQuotation"])->name("api.quote");
// Route::post("verify-items", [MainController::class, "verifyItems"])->name("cart.verify");
// Route::get("nosotros", [MainController::class, "about"])->name("about.index");
// Route::get("politicas", [MainController::class, "policies"])->name("policies.index");
// Route::get('carrito', [MainController::class, 'cartAndFavorites'])->name('cart.index');
// Route::get('favoritos', [MainController::class, 'cartAndFavorites'])->name('favorites.index');
// Route::get('buscar/{search?}', [MainController::class, 'search'])->name('search.index');
// Route::get('{categorySlug}', [MainController::class, 'category'])->name('category.index');
// Route::get('{categorySlug}/{productSlug}', [MainController::class, 'productDetail'])->name('product.detail');
