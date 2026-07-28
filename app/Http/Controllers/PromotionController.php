<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Promotion;

class PromotionController extends Controller
{
    public function __construct(public Product $product, public Promotion $promotion) {}

    public function detail(string $slug)
    {
        $data = $this->promotion->getBySlug(slug: $slug);
        $products = $this->product->getFeatured();
        return view('pages.promotions', compact('data', 'products'));
    }
}
