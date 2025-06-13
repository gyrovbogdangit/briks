import './bootstrap';
import 'jquery-ui/dist/jquery-ui.min.js'
import '@fancyapps/fancybox';
import * as bootstrap from 'bootstrap';

$(document).on('click', '[data-bs-toggle="offcanvas"][data-bs-target="#catalog-menu"]', function (e) {
    e.preventDefault();
    const offcanvasEl = document.getElementById('catalog-menu');
    const bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);
    bsOffcanvas.show();
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

$(document).on('mouseenter', '.catalog-type-link', function (e) {
    e.preventDefault();
    const typeId = $(this).data('type-id');

    $('.catalog-categories-menu').removeClass('active').addClass('d-none');

    $(`.catalog-categories-menu[data-categories-for='${typeId}']`).addClass('active').removeClass('d-none');

    $('.catalog-type-item').removeClass('active');
    $(this).closest('.catalog-type-item').addClass('active');

    $('.catalog-subcategories-menu').removeClass('active').addClass('d-none');
});

$(document).on('mouseenter', '.catalog-category-link', function () {
    const categoryId = $(this).data('category-id');

    $('.catalog-subcategories-menu').removeClass('active').addClass('d-none');

    $(`.catalog-subcategories-menu[data-subcategories-for='${categoryId}']`).addClass('active').removeClass('d-none');
});

$(document).on('mouseleave', '.catalog-categories-menu', function () {
    $('.catalog-subcategories-menu').removeClass('active').addClass('d-none');
});

$('#catalog-menu').on('show.bs.offcanvas', function () {
    $('.catalog-categories-menu').removeClass('active').addClass('d-none');
    $('.catalog-type-item').removeClass('active');
    $('.catalog-subcategories-menu').removeClass('active').addClass('d-none');
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
