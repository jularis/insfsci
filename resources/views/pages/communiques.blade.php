@extends('layouts.public')
@section('title', 'Communiqués')
@section('content')
    <div class="space-y-8">
        <section class="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm lowercase tracking-[0.24em] text-red-600">communiqués</p>
            <h1 class="mt-4 text-4xl font-bold text-slate-900">Informations officielles</h1>
            <p class="mt-6 text-slate-600 leading-8">Retrouvez les annonces, les concours et les directives publiées par l’INSFS.</p>
        </section>

        <div class="grid gap-6 lg:grid-cols-2">
            @foreach($communiques as $communique)
                <article class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <p class="text-sm lowercase tracking-[0.18em] text-slate-500">{{ $communique['date'] }}</p>
                    <h2 class="mt-4 text-2xl font-semibold text-slate-900">{{ $communique['title'] }}</h2>
                    <p class="mt-3 text-slate-600 leading-7">{{ $communique['excerpt'] }}</p>
                    <a href="{{ route('communiques.show', $communique['slug']) }}" class="mt-6 inline-flex items-center justify-center rounded-md bg-[#ff9700] px-5 py-3 text-sm font-bold uppercase text-white hover:bg-[#ed8700]">
                        Consulter
                    </a>
                </article>
            @endforeach
        </div>
    </div>
@endsection
