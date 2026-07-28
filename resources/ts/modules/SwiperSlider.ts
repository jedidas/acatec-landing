import Swiper from 'swiper';
import { Navigation, Thumbs } from 'swiper/modules';

export function ProductGallery() {
    const gallery = document.querySelector('.gallery');
    const galleryThumbs = document.querySelector('.gallery-thumbs');

    if (gallery && galleryThumbs) {
        var thumbs = new Swiper('.gallery-thumbs', {
            loop: true,
            spaceBetween: 10,
            slidesPerView: 4,
            watchSlidesProgress: true,
        });

        new Swiper('.gallery', {
            loop: true,
            spaceBetween: 10,
            modules: [Navigation, Thumbs],
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            thumbs: {
                swiper: thumbs,
            },
        });
    }
}

export function FeaturedSlider() {
    if (document.querySelector('.featured-slider')) {
        new Swiper('.featured-slider', {
            modules: [Navigation],
            loop: true,
            direction: 'horizontal',
            spaceBetween: 10,
            slidesPerView: 1,
            freeMode: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1600: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
            },
        });
    }
}
