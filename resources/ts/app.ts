import 'flowbite';

import ScrollTo from '@modules/ScrollTo';

import './bootstrap';
import LazyLoad from 'vanilla-lazyload';
import BannerSlider from '@modules/BannerSlider';
import ShopBag from '@modules/ShopBag';

import MobileMenu from '@modules/MobileMenu';
import HeadroomModule from '@modules/HeadroomModule';
import { FeaturedSlider } from '@modules/SwiperSlider';
import ContactForm from '@modules/ContactForm';
import OrderBy from '@modules/OrderBy';

document.addEventListener('DOMContentLoaded', function () {
    BannerSlider();
    FeaturedSlider();
    MobileMenu();
    HeadroomModule();
    ScrollTo('.wd-scroll');
    ShopBag();
    ContactForm();
    OrderBy();
    new LazyLoad();
});
