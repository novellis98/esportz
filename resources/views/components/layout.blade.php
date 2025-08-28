<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Default Title' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- aos css -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

</head>

<body>
    <x-header />
    @if (session()->has('success'))
        <div class="pt-5 alert alert-success" style="color: black !important;">
            {{ session('success') }}
        </div>
    @endif
    <main>
        {{ $slot }}

    </main>
    <button id="chat-button" class="btn btn-custom--sec position-fixed bottom-0 end-0 m-4 "><i class="bi bi-chat-fill"
            style="font-size: 1.5rem"></i></button>
    <div class="chat-container" id="chat-container">
        <div id="div-close-button"> <button id="close-button"><i class="bi bi-x"></i></button></div>
        <livewire:chat-component />
    </div>
    <x-footer />
    <!-- aos js -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
