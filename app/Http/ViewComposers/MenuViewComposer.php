<?php

namespace App\Http\ViewComposers;

use App\Models\Category;

class MenuViewComposer
{

    public function __construct(private Category $category)
    {
        $this->category = $category;
    }

    public function compose($view)
    {
        $categories = $this->category->getAllActive();
        $view->with('categories', $categories);
    }
}
