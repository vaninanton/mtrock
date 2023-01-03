<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta_title', config('app.name')) | Mountain-Rock.ru</title>
    <meta name="description" content="@yield('meta_description')">
    <link rel="canonical" href="@yield('canonical', URL::current())">
    <meta name="theme-color" content="#0350b1">

    <meta name="robots" content="index,follow">
    <meta name="google" content="nositelinkssearchbox">
    <meta name="google" content="notranslate">
    <meta name="format-detection" content="telephone=no">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <div class="flex flex-col bg-gray-50 min-h-screen justify-between">
        <div>
            <main class="container mx-auto p-4 bg-white">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
