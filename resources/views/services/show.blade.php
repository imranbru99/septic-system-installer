@extends('layouts.app')

@section('title', $service->name.' | Clearbasin')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-16">
    <div class="grid gap-10 md:grid-cols-2">
        <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="h-96 w-full rounded-2xl object-cover">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-teal">Service</p>
            <h1 class="mt-2 font-display text-4xl font-bold text-pine">{{ $service->name }}</h1>
            <p class="mt-3 text-lg text-ink/75">{{ $service->tagline }}</p>
            <div class="prose mt-6 max-w-none text-ink/80">{!! nl2br(e($service->description)) !!}</div>
            @if ($service->base_price)
                <p class="mt-6 text-sm font-semibold text-teal">Typical starting range: ${{ number_format($service->base_price, 0) }}</p>
            @endif
            <a href="{{ route('contact') }}" class="mt-6 inline-block rounded-md bg-pine px-5 py-3 text-sm font-bold text-white">Request evaluation</a>
        </div>
    </div>
</section>
@endsection
