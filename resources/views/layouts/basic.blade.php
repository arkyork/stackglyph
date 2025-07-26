<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="https://www.stackglyph.com/icon.png">
        <meta property="og:image" content="https://www.stackglyph.com/icon.png"/>

        <title>@yield("title")</title>
        <meta name="google-site-verification" content="CM0xkCc0cnHiLI9MMTAxSBH83Hk-DPcnfnRY6AahGrw" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @yield("head")
        
        @auth
        @else
            <!-- Google tag (gtag.js) -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-HEX1D46026"></script>
            <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}Add commentMore actions
            gtag('js', new Date());

            gtag('config', 'G-HEX1D46026');
            </script>
        @endauth
    </head>
    <body class="bg-slate-50 text-gray-800 font-sans">

    <?php
        $ranking_flag =str_contains(Request::route()->getName(),"ranking");
        $quiz_flag =str_contains(Request::route()->getName(),"quiz");
        $flag = $ranking_flag || $quiz_flag;
    ?>

    @include("parts.header")
    
    <div class="max-w-6xl mx-auto px-4 py-12 min-h-screen grid grid-cols-1 
    @if(!$flag) md:grid-cols-[1fr_250px] @endif gap-8">
        <main class="space-y-12">
        @yield("content")
        </main>
        @if(!$flag)
            <aside class="space-y-4">
            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200">
                <h2 class="text-lg font-bold border-b border-blue-400 pb-1 mb-3">カテゴリ</h2>
                <ul class="space-y-2">
                @foreach($categories as $category)
                    <li>
                    <a href="{{ route('categories.show', $category->id) }}"
                        class="flex justify-between px-3 py-2 rounded-md bg-gray-100 hover:bg-blue-100 transition">
                        <span>{{ $category->name }}</span>
                        <span>（{{ count($category->themes) }}）</span>

                    </a>
                    </li>
                @endforeach
                </ul>
            </div>
            </aside>
        @endif

    </div>

  @include("parts.footer")
</body>
</html>
