@extends('layouts.app')

@section('title', $article->title.' | Clearbasin KB')

@section('content')
<article class="mx-auto max-w-3xl px-4 py-16">
    <a href="{{ route('kb.index') }}" class="text-sm font-semibold text-teal">← Knowledge base</a>
    <h1 class="mt-4 font-display text-4xl font-bold text-pine">{{ $article->title }}</h1>
    <p class="mt-2 text-ink/65">{{ $article->summary }}</p>
    <div class="prose mt-8 max-w-none whitespace-pre-line text-ink/80">{{ $article->body }}</div>
</article>
@endsection
