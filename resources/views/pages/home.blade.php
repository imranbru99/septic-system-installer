@extends('layouts.app')

@section('title', 'Clearbasin Septic Systems | Hudson Valley NY')
@section('meta_description', 'Clearbasin Septic Systems installs and services residential septic systems across the Hudson Valley — soil tests, tanks, drain fields, and repairs.')

@section('content')
<section class="relative min-h-[88vh] overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=2000&q=80"
             alt="Excavation crew preparing a residential septic installation site"
             class="hero-pan h-full w-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-pine/92 via-pine/72 to-pine/28"></div>
    </div>
    <div class="relative mx-auto flex min-h-[88vh] max-w-6xl flex-col justify-center px-4 py-20 text-white">
        <p class="fade-up font-display text-5xl font-extrabold tracking-tight sm:text-7xl">Clearbasin</p>
        <h1 class="fade-up mt-4 max-w-xl text-2xl font-semibold text-mist sm:text-3xl" style="animation-delay:.12s">
            Engineered septic systems for Hudson Valley homes.
        </h1>
        <p class="fade-up mt-4 max-w-lg text-base text-mist/85 sm:text-lg" style="animation-delay:.22s">
            New installs, tank replacements, drain-field rebuilds, and emergency service — permitted, inspected, restored.
        </p>
        <div class="fade-up mt-8 flex flex-wrap gap-3" style="animation-delay:.32s">
            <a href="{{ route('contact') }}" class="rounded-md bg-gold px-5 py-3 text-sm font-bold text-ink">Book site evaluation</a>
            <a href="{{ route('services.index') }}" class="rounded-md border border-white/40 px-5 py-3 text-sm font-semibold text-white hover:bg-white/10">View services</a>
        </div>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-20">
    <div class="max-w-2xl">
        <h2 class="font-display text-3xl font-bold text-pine sm:text-4xl">Services sized to your soil and lot</h2>
        <p class="mt-3 text-ink/70">Perc testing, tank sizing, and drain-field layout before the first scoop of dirt.</p>
    </div>
    <div class="mt-10 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($services->take(6) as $service)
            <a href="{{ route('services.show', $service) }}" class="group block">
                <div class="overflow-hidden rounded-2xl">
                    <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="h-48 w-full object-cover transition duration-500 group-hover:scale-105">
                </div>
                <h3 class="mt-4 font-display text-xl font-bold text-pine">{{ $service->name }}</h3>
                <p class="mt-1 text-sm text-ink/70">{{ $service->tagline }}</p>
            </a>
        @endforeach
    </div>
</section>

<section class="bg-pine text-mist">
    <div class="mx-auto grid max-w-6xl items-center gap-10 px-4 py-20 md:grid-cols-2">
        <div>
            <h2 class="font-display text-3xl font-bold text-white sm:text-4xl">About Clearbasin</h2>
            <p class="mt-4 text-mist/80">
                We are a Poughkeepsie-based septic installer focused on residential and light-commercial systems —
                conventional tanks, chamber fields, and advanced treatment units matched to Mid-Hudson soils and setbacks.
            </p>
            <a href="{{ route('about') }}" class="mt-6 inline-block rounded-md bg-teal px-4 py-2 text-sm font-semibold text-white">Our story</a>
        </div>
        <img src="https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=1200&q=80"
             alt="Heavy equipment staged for underground utility and septic excavation"
             class="h-80 w-full rounded-2xl object-cover">
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 py-20">
    <div class="max-w-2xl">
        <h2 class="font-display text-3xl font-bold text-pine">Operations dashboard preview</h2>
        <p class="mt-3 text-ink/70">Crews schedule installs, track tank inventory, invoices, and AI assistants from the Clearbasin ERP.</p>
    </div>
    <div class="mt-8 overflow-hidden rounded-3xl border border-pine/10 bg-white shadow-xl">
        <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&w=1600&q=80"
             alt="Underground piping and fittings prepared for a septic system install"
             class="h-72 w-full object-cover md:h-96">
        <div class="grid gap-4 p-6 sm:grid-cols-3">
            <div>
                <p class="text-xs uppercase tracking-wide text-teal">Active installs</p>
                <p class="font-display text-3xl font-bold text-pine">18</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-wide text-teal">Crews today</p>
                <p class="font-display text-3xl font-bold text-pine">5</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-wide text-teal">Site evals booked</p>
                <p class="font-display text-3xl font-bold text-pine">9</p>
            </div>
        </div>
    </div>
</section>

<section class="mx-auto max-w-6xl px-4 pb-20">
    <div class="flex items-end justify-between gap-4">
        <h2 class="font-display text-3xl font-bold text-pine">From the field journal</h2>
        <a href="{{ route('blog.index') }}" class="text-sm font-semibold text-teal">All posts</a>
    </div>
    <div class="mt-8 grid gap-8 md:grid-cols-3">
        @foreach ($posts as $post)
            <a href="{{ route('blog.show', $post) }}" class="block">
                <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" class="h-44 w-full rounded-xl object-cover">
                <h3 class="mt-3 font-display text-lg font-bold text-pine">{{ $post->title }}</h3>
                <p class="mt-1 text-sm text-ink/65">{{ $post->excerpt }}</p>
            </a>
        @endforeach
    </div>
</section>

<section class="border-t border-pine/10 bg-mist/60">
    <div class="mx-auto flex max-w-6xl flex-col items-start justify-between gap-6 px-4 py-16 md:flex-row md:items-center">
        <div>
            <h2 class="font-display text-3xl font-bold text-pine">Need a septic that passes inspection?</h2>
            <p class="mt-2 text-ink/70">Site evaluations across the Hudson Valley. WhatsApp or form — your choice.</p>
        </div>
        <a href="{{ route('contact') }}" class="rounded-md bg-pine px-5 py-3 text-sm font-bold text-white">Contact Clearbasin</a>
    </div>
</section>
@endsection
