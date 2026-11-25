<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Clearbasin Septic Systems')</title>
    <meta name="description" content="@yield('meta_description', 'Clearbasin Septic Systems — engineered septic installation, repairs, and drain-field design for Hudson Valley homes.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:wght@600;700;800&family=Sora:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen antialiased">
    <header class="relative z-40 border-b border-teal/10 bg-foam/80 backdrop-blur-md">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-4">
            <a href="{{ route('home') }}" class="font-display text-xl font-extrabold tracking-tight text-pine sm:text-2xl">
                Clearbasin
            </a>
            <nav class="hidden items-center gap-6 text-sm font-semibold text-ink/80 md:flex">
                <a href="{{ route('services.index') }}" class="hover:text-teal">Services</a>
                <a href="{{ route('about') }}" class="hover:text-teal">About</a>
                <a href="{{ route('blog.index') }}" class="hover:text-teal">Blog</a>
                <a href="{{ route('kb.index') }}" class="hover:text-teal">Knowledge Base</a>
                <a href="{{ route('contact') }}" class="hover:text-teal">Contact</a>
                <a href="/admin" class="rounded-md bg-pine px-3 py-2 text-white hover:bg-teal">ERP Login</a>
            </nav>
            <a href="{{ route('contact') }}" class="rounded-md bg-gold px-3 py-2 text-sm font-bold text-ink md:hidden">Quote</a>
        </div>
    </header>

    <main>
        @if (session('success'))
            <div class="mx-auto max-w-6xl px-4 pt-4">
                <div class="rounded-lg border border-teal/20 bg-mist px-4 py-3 text-sm text-pine">{{ session('success') }}</div>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="mt-20 border-t border-pine/10 bg-pine text-mist">
        <div class="mx-auto grid max-w-6xl gap-8 px-4 py-12 md:grid-cols-3">
            <div>
                <p class="font-display text-2xl font-bold text-white">Clearbasin</p>
                <p class="mt-2 text-sm text-mist/80">Septic design, installation, and service for Hudson Valley properties. Soil-first engineering, code-ready systems, tidy restoration.</p>
            </div>
            <div>
                <p class="font-semibold text-white">Visit</p>
                <p class="mt-2 text-sm text-mist/80">418 Mill Street<br>Poughkeepsie, NY 12601<br>(845) 555-0192</p>
            </div>
            <div>
                <p class="font-semibold text-white">Explore</p>
                <div class="mt-2 flex flex-col gap-1 text-sm">
                    <a href="{{ route('services.index') }}" class="hover:text-gold">Services</a>
                    <a href="{{ route('kb.index') }}" class="hover:text-gold">Knowledge Base</a>
                    <a href="/admin" class="hover:text-gold">Staff ERP</a>
                </div>
            </div>
        </div>
        <div class="border-t border-white/10 py-4 text-center text-xs text-mist/60">
            © {{ date('Y') }} Clearbasin Septic Systems. All rights reserved.
        </div>
    </footer>

    <a href="https://wa.me/18455550192" target="_blank" rel="noopener"
       class="fixed bottom-5 right-5 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-[#25D366] text-2xl text-white shadow-lg float-soft"
       aria-label="WhatsApp Clearbasin">💬</a>

    @include('components.chatbot')
</body>
</html>
