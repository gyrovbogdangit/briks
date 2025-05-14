import './bootstrap';
import 'jquery-ui/dist/jquery-ui.min.js'
import '@fancyapps/fancybox';
import * as bootstrap from 'bootstrap';

// Открытие offcanvas каталога по клику на кнопку
$(document).on('click', '[data-bs-toggle="offcanvas"][data-bs-target="#catalog-menu"]', function (e) {
    e.preventDefault();
    const offcanvasEl = document.getElementById('catalog-menu');
    const bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);
    bsOffcanvas.show();
});

// Автоматически закрывать все вложенные collapse при закрытии меню
const catalogMenu = document.getElementById('catalog-menu');
if (catalogMenu) {
    catalogMenu.addEventListener('hidden.bs.offcanvas', function () {
        const opened = catalogMenu.querySelectorAll('.collapse.show');
        opened.forEach(el => bootstrap.Collapse.getOrCreateInstance(el).hide());
    });
}

// Автоматически закрывать вложенные подменю при открытии другого на том же уровне
$(document).on('show.bs.collapse', '.collapse', function () {
    const parent = $(this).parent().parent();
    parent.find('> .collapse.show').not(this).each(function () {
        bootstrap.Collapse.getOrCreateInstance(this).hide();
    });
});

/* import 'theia-sticky-sidebar/dist/ResizeSensor.min';
import 'theia-sticky-sidebar/dist/theia-sticky-sidebar.min';

import 'jscrollpane/script/jquery.mousewheel';
import 'jscrollpane/script/jquery.jscrollpane.min';

import 'slick-carousel/slick/slick.min';
 */
