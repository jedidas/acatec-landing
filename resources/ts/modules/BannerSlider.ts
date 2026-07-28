import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

export default function BannerSlider() {
    if (document.querySelector('.banner-slider')) {
        new Swiper('.banner-slider', {
            modules: [Navigation, Pagination],
            loop: true,
            direction: 'horizontal',
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
            },
        });
    }
}
