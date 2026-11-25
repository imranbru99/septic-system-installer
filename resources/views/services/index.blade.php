@extends('layouts.app')

@section('title', 'Septic Services | Clearbasin')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-16">
    <h1 class="font-display text-4xl font-bold text-pine">Septic installation & service</h1>
    <p class="mt-3 max-w-2xl text-ink/70">From soil evaluation to final inspection — scoped clearly before the excavator arrives.</p>
    <div class="mt-10 grid gap-8 md:grid-cols-2">
        @foreach ($services as $service)
            <a href="{{ route('services.show', $service) }}" class="overflow-hidden rounded-2xl border border-pine/10 bg-white/70 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="h-56 w-full object-cover">
                <div class="p-5">
                    <h2 class="font-display text-2xl font-bold text-pine">{{ $service->name }}</h2>
                    <p class="mt-2 text-sm text-ink/70">{{ $service->summary }}</p>
                    @if ($service->base_price)
                        <p class="mt-3 text-sm font-semibold text-teal">From ${{ number_format($service->base_price, 0) }}</p>
                    @endif
                </div>
            </a>
        @endforeach
    </div>
</section>
@endsection
