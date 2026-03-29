import './bootstrap';
import 'jquery-ui/dist/jquery-ui.min.js'
import '@fancyapps/fancybox';
import * as bootstrap from 'bootstrap';
import { initSwiperSliders, registerLivewireSwiperIntegration } from './swiper-sliders';

const catalogEl = document.getElementById('catalog-menu');
const toggleBtn = document.getElementById('catalog-toggle-btn');

const bsOffcanvas = new bootstrap.Offcanvas(catalogEl);

toggleBtn.addEventListener('click', function (e) {
    e.preventDefault();
    bsOffcanvas.show();
});

const buttons = document.querySelectorAll('.catalog-type-btn');
const panes = document.querySelectorAll('.catalog-pane');

buttons.forEach(btn => {
    btn.addEventListener('mouseenter', function () {
        const targetId = this.getAttribute('data-type-target');

        buttons.forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        panes.forEach(pane => {
            pane.classList.toggle('d-none', pane.id !==
                `pane-${targetId}`);
        });
    });
});

const catalogMenu = document.getElementById('catalog-menu');
if (catalogMenu) {
    catalogMenu.addEventListener('hidden.bs.offcanvas', function () {
        const opened = catalogMenu.querySelectorAll('.collapse.show');
        opened.forEach(el => bootstrap.Collapse.getOrCreateInstance(el).hide());
    });
}

$(document).on('show.bs.collapse', '.collapse', function () {
    const parent = $(this).parent().parent();
    parent.find('> .collapse.show').not(this).each(function () {
        bootstrap.Collapse.getOrCreateInstance(this).hide();
    });
});

$(document).on('mouseenter', '.catalog-type-item', function (e) {
    e.preventDefault();
    const typeId = $(this).data('type-id');

    $('.catalog-detail').addClass('d-none');
    $(`.catalog-detail[data-for='${typeId}']`).removeClass('d-none');

    $('.catalog-type-item').removeClass('active');
    $(this).addClass('active');
});

$('#catalog-menu').on('show.bs.offcanvas', function () {
    $('.catalog-detail').addClass('d-none');
    $('.catalog-type-item').removeClass('active');

    const firstTypeId = $('.catalog-type-item').first().data('type-id');
    if (firstTypeId !== undefined) {
        $(`.catalog-detail[data-for='${firstTypeId}']`).removeClass('d-none');
        $(`.catalog-type-item[data-type-id='${firstTypeId}']`).addClass('active');
    }
});

$(function () {
    $(document).on('click', '.show-more-values-btn', function () {
        const attrId = $(this).data('attribute-id');
        $(`.more-values-${attrId}`).removeClass('d-none');
        $(this).addClass('d-none');
        $(this).siblings('.hide-more-values-btn').removeClass('d-none');
    });

    $(document).on('click', '.hide-more-values-btn', function () {
        const attrId = $(this).data('attribute-id');
        $(`.more-values-${attrId}`).addClass('d-none');
        $(this).addClass('d-none');
        $(this).siblings('.show-more-values-btn').removeClass('d-none');
    });

    $('a[href="#chars"]').on('click', function (e) {
        e.preventDefault();
        const $tabTrigger = $("button[data-bs-target='#chars']");
        if ($tabTrigger.length) {
            $tabTrigger.trigger('click');
            const $charsTab = $('#chars');
            if ($charsTab.length) {
                $charsTab[0].scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
    });


});

document.addEventListener('DOMContentLoaded', () => {
    initSwiperSliders();
});

registerLivewireSwiperIntegration();

document.addEventListener('livewire:navigated', () => {
    initSwiperSliders();
});
