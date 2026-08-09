<!DOCTYPE html>
<html lang="id" data-theme="{{ $theme ?? 'stanford' }}">

<head>
    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-VDY9RFSEFG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-VDY9RFSEFG');
    </script> --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Website Perguruan Tinggi' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>

<body class="min-h-screen flex flex-col
           bg-background
           text-text
           antialiased">

    <livewire:navbar :config="$site_config" />

    <main class="flex-grow">

        {{ $slot }}

    </main>

    <livewire:marquee-bottom :config="$site_config" />

    <livewire:footer :config="$site_config" />

    @livewireScripts
</body>

</html>
