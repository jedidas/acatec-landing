import 'flowbite';

import Cart from '@modules/Cart';
import Favorites from '@modules/Favorites';
import ShareSocial from '@modules/ShareSocial';
import { ProductGallery } from '@modules/SwiperSlider';

document.addEventListener('DOMContentLoaded', function () {
    ProductGallery();
    ShareSocial();
    Cart();
    Favorites();
});
