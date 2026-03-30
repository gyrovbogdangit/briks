import Swiper from 'swiper';
import { Autoplay, Keyboard, Navigation, Pagination } from 'swiper/modules';

let morphDebounce = null;

function destroyIfAny(el) {
    if (el?.swiper) {
        el.swiper.destroy(true, true);
    }
}

function productsSwiperBaseConfig(el, row, prev, next, paginationEl) {
    return {
        modules: [Keyboard, Navigation, Pagination],
        slidesPerView: 2.12,
        spaceBetween: 12,
        grabCursor: true,
        keyboard: { enabled: true },
        watchOverflow: true,
        observer: true,
        observeParents: true,
        observeSlideChildren: true,
        breakpoints: {
            576: {
                slidesPerView: 2,
                spaceBetween: 14,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 16,
            },
            992: {
                slidesPerView: 5,
                spaceBetween: 16,
            },
        },
        navigation:
            prev && next
                ? {
                      prevEl: prev,
                      nextEl: next,
                  }
                : undefined,
        pagination: paginationEl
            ? {
                  el: paginationEl,
                  clickable: true,
                  dynamicBullets: true,
              }
            : undefined,
    };
}

function initHeroSwiper() {
    const el = document.querySelector('.hero-swiper');
    if (!el) return;

    destroyIfAny(el);

    const slides = el.querySelectorAll('.swiper-slide').length;
    if (slides === 0) return;

    const paginationEl = el.querySelector('.swiper-pagination');
    const prevEl = el.querySelector('.swiper-button-prev');
    const nextEl = el.querySelector('.swiper-button-next');

    new Swiper(el, {
        modules: [Autoplay, Keyboard, Navigation, Pagination],
        loop: slides > 1,
        speed: 500,
        grabCursor: true,
        autoplay:
            slides > 1
                ? {
                      delay: 5000,
                      pauseOnMouseEnter: true,
                      disableOnInteraction: false,
                  }
                : false,
        keyboard: { enabled: true },
        watchOverflow: true,
        pagination: paginationEl
            ? {
                  el: paginationEl,
                  clickable: true,
              }
            : undefined,
        navigation:
            prevEl && nextEl
                ? {
                      prevEl,
                      nextEl,
                  }
                : undefined,
    });
}

function initProductsSwipers() {
    document.querySelectorAll('[data-products-slider]').forEach((el) => {
        const row = el.closest('.carousel-products-row');
        const prev = row?.querySelector('.products-swiper-prev');
        const next = row?.querySelector('.products-swiper-next');
        const paginationEl = el.querySelector('.products-swiper-pagination');

        if (el.swiper) {
            el.swiper.update();
            el.swiper.updateSlides();
            el.swiper.updateSlidesClasses();
            el.swiper.updateSize();
            el.swiper.navigation?.update?.();
            el.swiper.pagination?.update?.();
            return;
        }

        destroyIfAny(el);

        new Swiper(el, productsSwiperBaseConfig(el, row, prev, next, paginationEl));
    });
}

/** После morph Livewire (карточки в слайдах) — только пересчёт, без destroy */
export function refreshProductsSwipersAfterLivewire() {
    document.querySelectorAll('[data-products-slider]').forEach((el) => {
        if (!el.swiper) return;
        el.swiper.update();
        el.swiper.updateSlides();
        el.swiper.updateSlidesClasses();
        el.swiper.updateSize();
        el.swiper.navigation?.update?.();
        el.swiper.pagination?.update?.();
    });
}


export function initSwiperSliders() {
    initHeroSwiper();
    initProductsSwipers();
}

/**
 * Livewire отрисовывает product-item после первого paint; без этого слайдер на странице товара пустой/ломается.
 */
export function registerLivewireSwiperIntegration() {
    const runAfterLivewire = () => {
        initSwiperSliders();
    };

    document.addEventListener('livewire:init', () => {
        runAfterLivewire();

        if (typeof window.Livewire === 'undefined') return;

        window.Livewire.hook('morph.updated', () => {
            clearTimeout(morphDebounce);
            morphDebounce = setTimeout(() => {
                refreshProductsSwipersAfterLivewire();
            }, 50);
        });
    });

    if (window.Livewire) {
        queueMicrotask(runAfterLivewire);
    }
}
