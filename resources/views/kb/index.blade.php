@extends('layouts.app')

@section('title', 'Knowledge Base | Clearbasin')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-16">
    <h1 class="font-display text-4xl font-bold text-pine">Knowledge base</h1>
    <p class="mt-3 max-w-2xl text-ink/70">Homeowner guides, admin manual excerpts, and troubleshooting for septic installation operations.</p>

    @foreach ($articles as $category => $items)
        <div class="mt-12">
            <h2 class="font-display text-2xl font-bold capitalize text-teal">{{ str_replace('-', ' ', $category) }}</h2>
            <div class="mt-4 grid gap-4 md:grid-cols-2">
                @foreach ($items as $article)
                    <a href="{{ route('kb.show', $article) }}" class="rounded-xl border border-pine/10 bg-white/70 p-5 hover:border-teal/40">
                        <h3 class="font-semibold text-pine">{{ $article->title }}</h3>
                        <p class="mt-1 text-sm text-ink/65">{{ $article->summary }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    @endforeach
</section>
@endsection
