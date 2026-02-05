<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('layouts.components.seo')

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <link rel="preload" href="/css/font-awesome/all.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link href="/css/font-awesome/all.min.css" rel="stylesheet">
    </noscript>


    <!-- Yandex.Metrika counter -->
    <meta name="yandex-verification" content="70e92b50ce025327" />
    <script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            for (var j = 0; j < document.scripts.length; j++) {
                if (document.scripts[j].src === r) {
                    return;
                }
            }
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(
                k, a)
        })(window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js?id=103434813', 'ym');

        ym(103434813, 'init', {
            ssr: true,
            webvisor: true,
            clickmap: true,
            ecommerce: "dataLayer",
            accurateTrackBounce: true,
            trackLinks: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/103434813" style="position:absolute; left:-9999px;" alt="" />
        </div>
    </noscript>
    <!-- /Yandex.Metrika counter -->
    @yield('css')
    @livewireStyles
</head>

<body class="bg-body-tertiary min-vh-100 d-flex flex-column">
    @include('layouts.components.header')
    <main class="flex-grow-1">
        @yield('content')
    </main>
    @include('layouts.components.footer')

    @include('layouts.components.catalog-menu')
    {{--
    <div style="display: none;" class="modal modal--bottom" id="request-call">
        <livewire:modal-request-call />
    </div>

    <div class="overflow-bg"></div> --}}

    @yield('js')
    @livewireScripts(['defer' => true])
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (!localStorage.getItem('cookieAccepted')) {
                const cookieBanner = document.createElement('div');
                cookieBanner.innerHTML = `
                    <div id="cookie-banner" style="position:fixed;bottom:0;left:0;width:100%;background:#222;color:#fff;padding:16px 10px;z-index:9999;display:flex;justify-content:center;align-items:center;gap:16px;box-shadow:0 -2px 8px rgba(0,0,0,0.1);font-size:1rem;">
                        <span>Мы используем cookie для улучшения работы сайта. Продолжая пользоваться сайтом, вы соглашаетесь с <a href='/privacy' style='color:#ffd700;text-decoration:underline;'>политикой конфиденциальности</a>.</span>
                        <button id="cookie-accept-btn" style="background:#ffd700;color:#222;border:none;padding:8px 18px;border-radius:6px;font-weight:600;cursor:pointer;">Ок</button>
                    </div>
                `;
                document.body.appendChild(cookieBanner);
                document.getElementById('cookie-accept-btn').onclick = function() {
                    localStorage.setItem('cookieAccepted', '1');
                    document.getElementById('cookie-banner').remove();
                };
            }
        });
    </script>

    <script src="https://app2.gnzs.ru/site-integration/js/script.v3.js" data-platform="amo" data-account="32871390" data-token="c4f7824a-15b7-4a04-8dae-ed5a2addbef3"></script>
</body>

</html>
