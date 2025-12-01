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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Background putih abu-abu seperti default */
        .main-bg {
            background-color: #f3f4f6; /* gray-100 */
        }

        .btn-primary {
            background-color: #1b72e8;
            color: #ffffff;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1557b0;
        }

        .logo-text {
            color: #1b1b1b;
        }

        .card-container {
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 main-bg">
        <div>
            <a href="/">
                <h1 class="text-3xl font-bold logo-text mb-8">STUDIFY</h1>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 card-container overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
