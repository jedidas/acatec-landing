<?php

namespace App\Http\ViewComposers;

use App\Models\Product;

class FeaturedProductsViewComposer
{
    public function __construct(private Product $product) {}

    public function compose($view)
    {
        $products = $this->product->getFeatured();
        $view->with('products', $products);
    }
}
