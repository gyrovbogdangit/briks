<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('layouts.components.seo')

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&family=Unbounded:wght@700&display=swap"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

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
    @livewireScripts
</body>

</html>
