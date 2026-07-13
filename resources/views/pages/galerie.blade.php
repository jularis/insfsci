@extends('layouts.public')

@section('title', 'Galerie')

@section('content')
    @php
        $galleryItems = collect($gallerySections ?? [])
            ->flatMap(fn ($section) => collect($section['items'] ?? []))
            ->values()
            ->all();
    @endphp

    <div class="space-y-8">
        <header>
            <h1 class="text-3xl font-bold text-slate-900">Liste des galeries photos</h1>
        </header>

        <div class="grid gap-6 lg:grid-cols-3">
            @forelse($galleryItems as $item)
                <article class="overflow-hidden rounded-lg bg-white shadow-sm ring-1 ring-slate-200">
                    @if(!empty($item['image']))
                        <a href="{{ route('galerie.show', $item['slug']) }}" class="block aspect-[4/3] overflow-hidden bg-slate-100">
                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="h-full w-full object-cover transition duration-300 hover:scale-105" loading="lazy">
                        </a>
                    @endif

                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-slate-900">{{ $item['title'] }}</h2>

                        @if(!empty($item['excerpt']))
                            <p class="mt-3 text-sm leading-6 text-slate-600">{{ $item['excerpt'] }}</p>
                        @endif

                        <a href="{{ route('galerie.show', $item['slug']) }}" class="mt-5 inline-flex items-center justify-center rounded-md bg-[#ff9700] px-5 py-3 text-sm font-bold uppercase text-white hover:bg-[#ed8700]">
                            Consulter
                        </a>
                    </div>
                </article>
            @empty
                <section class="rounded-lg bg-white p-8 shadow-sm ring-1 ring-slate-200 lg:col-span-3">
                    <p class="text-slate-600 leading-8">Aucune galerie photo publiee pour le moment.</p>
                </section>
            @endforelse
        </div>
    </div>
@endsection
