<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --main-color: #1b72e8;
            --main-hover: #1557b0;
        }

        .text-primary {
            color: var(--main-color);
        }

        .btn-primary {
            background-color: var(--main-color);
            color: #ffffff;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--main-hover);
        }

        * {
            box-sizing: border-box;
        }

        /* Hilangkan margin default h2 */
        h2 {
            margin: 0 !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">

        @include('layouts.navigation')

        @if (isset($header))
        <header class="bg-transparent shadow-none">
            <div class="max-w-7xl mx-auto pt-4 pb-2 px-4 sm:px-6 lg:px-8">
                <h2 class="font-bold text-4xl text-black leading-tight text-center m-0">
                {{ $header }}
                </h2>
            </div>
        </header>
        @endif

        <main>
            {{ $slot }}
        </main>

    </div>
</body>
</html>
