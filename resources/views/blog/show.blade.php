@extends('layouts.app')

@section('title', $post->title.' | Clearbasin Blog')

@section('content')
<article class="mx-auto max-w-3xl px-4 py-16">
    <p class="text-xs font-semibold uppercase tracking-wide text-teal">{{ $post->category }}</p>
    <h1 class="mt-2 font-display text-4xl font-bold text-pine">{{ $post->title }}</h1>
    <p class="mt-2 text-sm text-ink/60">{{ optional($post->published_at)->format('M j, Y') }}</p>
    @if ($post->cover_image)
        <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" class="mt-8 h-72 w-full rounded-2xl object-cover">
    @endif
    <div class="prose mt-8 max-w-none whitespace-pre-line text-ink/80">{{ $post->body }}</div>
</article>
@endsection
