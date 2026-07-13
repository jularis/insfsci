@extends('layouts.public')
@section('title', 'Actualités')
@section('content')
    <div class="space-y-8">
        <div class="rounded-3xl bg-white p-4 shadow-sm ring-1 ring-slate-200">
            <nav class="flex flex-wrap items-center gap-4 text-sm text-slate-600">
                <a href="{{ route('home') }}" class="hover:text-red-600 transition">Accueil</a>
                <a href="{{ route('communiques') }}" class="hover:text-red-600 transition">Communiqués</a>
                <span class="font-semibold text-slate-900">Actualités</span>
                <a href="{{ route('contact') }}" class="hover:text-red-600 transition">Contactez-nous</a>
            </nav>
        </div>

        <section class="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm lowercase tracking-[0.24em] text-red-600">actualités</p>
            <h1 class="mt-4 text-4xl font-bold text-slate-900">Dernières nouvelles</h1>
            <p class="mt-6 text-slate-600 leading-8">Les dernières activités, événements et annonces de l’INSFS.</p>
        </section>

        <div class="grid gap-6 lg:grid-cols-3">
            @foreach($news as $item)
                <article class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200">
                    @if(!empty($item['image']))
                        <a href="{{ route('actualites.show', $item['slug']) }}" class="block aspect-[4/3] overflow-hidden bg-slate-100">
                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="h-full w-full object-cover transition duration-300 hover:scale-105" loading="lazy">
                        </a>
                    @else
                        <div class="aspect-[4/3] bg-slate-100"></div>
                    @endif

                    <div class="p-6">
                        <p class="text-sm lowercase tracking-[0.18em] text-slate-500">{{ $item['date'] }}</p>
                        <h2 class="mt-4 text-2xl font-semibold text-slate-900">{{ $item['title'] }}</h2>
                        <p class="mt-3 text-slate-600 leading-7">{{ $item['excerpt'] }}</p>
                        <a href="{{ route('actualites.show', $item['slug']) }}" class="mt-6 inline-flex items-center justify-center rounded-md bg-[#ff9700] px-5 py-3 text-sm font-bold uppercase text-white hover:bg-[#ed8700]">
                            Consulter
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
@endsection
