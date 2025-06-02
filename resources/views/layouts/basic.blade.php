<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="/icon.png">
        <title>@yield("title")</title>
        <meta name="google-site-verification" content="CM0xkCc0cnHiLI9MMTAxSBH83Hk-DPcnfnRY6AahGrw" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @yield("head")
    </head>
    <body class="bg-gray-100 text-gray-800 font-sans">
        @include("parts.header")
        <main class="max-w-4xl mx-auto py-10 px-4 space-y-10 min-h-screen">
            @yield("content")
        </main>
        @include("parts.footer")

    </body>
</html>
