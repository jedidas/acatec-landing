<?php

namespace App\Http\ViewComposers;

use App\Models\Banner;

class BannerViewComposer
{
    public function __construct(private Banner $banner)
    {
        $this->banner = $banner;
    }

    public function compose($view)
    {
        $banners = $this->banner->getActive();
        $view->with('banners', $banners);
    }
}
