@extends('layouts.public')

@section('title', 'Recherche')

@section('content')
    <div class="space-y-8">
        <section class="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm lowercase tracking-[0.24em] text-red-600">recherche</p>
            <h1 class="mt-4 text-4xl font-bold text-slate-900">Recherche</h1>
            <p class="mt-4 max-w-3xl text-slate-600 leading-8">
                Recherchez dans les pages, actualites, communiques, services, etablissements, galerie et contenus de l'institut.
            </p>

            <form action="{{ route('recherche') }}" method="GET" class="mt-6 flex flex-col gap-3 sm:flex-row">
                <input type="search" name="q" value="{{ $query }}" placeholder="Votre recherche..." class="w-full rounded-3xl border border-slate-200 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-100" />
                <button type="submit" class="inline-flex items-center justify-center rounded-full bg-red-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-red-700">
                    Rechercher
                </button>
            </form>
        </section>

        @if($query !== '')
            <p class="px-2 text-sm font-semibold text-slate-600">
                {{ count($results) }} resultat{{ count($results) > 1 ? 's' : '' }} pour "{{ $query }}"
            </p>
        @endif

        <div class="space-y-4">
            @forelse($results as $result)
                <a href="{{ $result['url'] }}" class="block rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition hover:ring-red-200">
                    <div class="flex flex-wrap items-center gap-3 text-xs font-bold uppercase tracking-[0.18em] text-red-600">
                        <span>{{ $result['type'] ?? 'Page' }}</span>
                        @isset($result['date'])
                            <span class="text-slate-400">{{ $result['date'] }}</span>
                        @endisset
                    </div>
                    <h2 class="mt-3 text-2xl font-semibold text-slate-900">{{ $result['title'] }}</h2>
                    <p class="mt-3 text-slate-600 leading-7">{{ $result['excerpt'] }}</p>
                </a>
            @empty
                <div class="rounded-3xl bg-white p-6 text-slate-600 shadow-sm ring-1 ring-slate-200">
                    @if($query === '')
                        Entrez un mot-cle pour lancer la recherche.
                    @else
                        Aucun resultat trouve pour "{{ $query }}".
                    @endif
                </div>
            @endforelse
        </div>
    </div>
@endsection
