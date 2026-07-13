@extends('layouts.public')

@section('title', 'Services')

@section('content')
    <div class="space-y-8">
        <header class="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm lowercase tracking-[0.24em] text-red-600">services</p>
            <h1 class="mt-4 text-4xl font-bold text-slate-900">Nos services de formation et d'accompagnement</h1>
            <p class="mt-6 text-slate-600 leading-8">
                L'INSFS propose des services dedies a la scolarite, a la documentation, aux stages et a la recherche pour soutenir ses etudiants et ses partenaires.
            </p>
        </header>

        <div class="grid gap-6 lg:grid-cols-2">
            @foreach($services as $service)
                <article id="{{ $service['slug'] }}" class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <h2 class="text-2xl font-semibold text-slate-900">{{ $service['name'] }}</h2>
                    <p class="mt-4 text-slate-600">{{ $service['description'] }}</p>
                    <p class="mt-4 text-sm text-slate-500">{{ $service['excerpt'] }}</p>
                    <a href="{{ route('services.show', $service['slug']) }}" class="mt-6 inline-flex items-center justify-center rounded-md bg-[#ff9700] px-5 py-3 text-sm font-bold uppercase text-white hover:bg-[#ed8700]">
                        Consulter
                    </a>
                </article>
            @endforeach
        </div>
    </div>
@endsection
