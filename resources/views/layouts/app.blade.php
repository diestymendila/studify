<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CDN (backup jika Vite gagal) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Warna utama platform */
        :root {
            --main-color: #1b72e8;
            --main-hover: #1557b0;
        }

        /* Header navbar */
        .header-bg {
            background-color: var(--main-color);
        }

        /* Untuk teks yang perlu warna brand */
        .text-primary {
            color: var(--main-color);
        }

        /* Tombol custom */
        .btn-primary {
            background-color: var(--main-color);
            color: #ffffff;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: var(--main-hover);
        }

        /* Pastikan layout tidak rusak */
        * {
            box-sizing: border-box;
        }
    </style>

</head>
<body class="font-sans antialiased bg-gray-100">

    <div class="min-h-screen">

        {{-- NAVIGATION (Breeze Navbar) --}}
        @include('layouts.navigation')

        {{-- PAGE HEADER --}}
        @if (isset($header))
            <header class="header-bg shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-white leading-tight">
                        {{ $header }}
                    </h2>
                </div>
            </header>
        @endif

        {{-- PAGE CONTENT --}}
        <main>
            {{ $slot }}
        </main>

    </div>

</body>
</html>
