@extends('layouts.app')

@section('title', 'Septic Blog | Clearbasin')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-16">
    <h1 class="font-display text-4xl font-bold text-pine">Blog & field notes</h1>
    <p class="mt-3 text-ink/70">Drain-field tips, maintenance guides, and Hudson Valley soil advice.</p>
    <div class="mt-10 grid gap-8 md:grid-cols-3">
        @foreach ($posts as $post)
            <a href="{{ route('blog.show', $post) }}" class="block">
                <img src="{{ $post->cover_image }}" alt="{{ $post->title }}" class="h-44 w-full rounded-xl object-cover">
                <p class="mt-3 text-xs font-semibold uppercase text-teal">{{ $post->category }}</p>
                <h2 class="mt-1 font-display text-xl font-bold text-pine">{{ $post->title }}</h2>
                <p class="mt-1 text-sm text-ink/65">{{ $post->excerpt }}</p>
            </a>
        @endforeach
    </div>
    <div class="mt-10">{{ $posts->links() }}</div>
</section>
@endsection
