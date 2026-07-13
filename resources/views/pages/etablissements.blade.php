@extends('layouts.public')

@section('title', 'Etablissements')

@section('content')
    <div class="space-y-8">
        <header class="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm lowercase tracking-[0.24em] text-red-600">etablissements</p>
            <h1 class="mt-4 text-4xl font-bold text-slate-900">Nos ecoles et formations</h1>
            <p class="mt-6 text-slate-600 leading-8">
                Decouvrez les etablissements de l'INSFS qui preparent aux metiers du social et de l'education specialisee.
            </p>
        </header>

        <div class="grid gap-6 lg:grid-cols-3">
            @foreach($establishments as $establishment)
                <section id="{{ $establishment['slug'] }}" class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <h2 class="text-2xl font-semibold text-slate-900">{{ $establishment['name'] }}</h2>
                    <p class="mt-4 text-slate-600">{{ $establishment['excerpt'] }}</p>
                    <div class="mt-6 space-y-4 text-sm text-slate-600">
                        <div>
                            <span class="font-semibold text-slate-900">Prerequis :</span>
                            <div>{{ $establishment['requirements'] }}</div>
                        </div>
                        <div>
                            <span class="font-semibold text-slate-900">Objectifs :</span>
                            <div>{{ $establishment['objectives'] }}</div>
                        </div>
                    </div>
                    <a href="{{ route('etablissements.show', $establishment['slug']) }}" class="mt-6 inline-flex items-center justify-center rounded-md bg-[#ff9700] px-5 py-3 text-sm font-bold uppercase text-white hover:bg-[#ed8700]">
                        Consulter
                    </a>
                </section>
            @endforeach
        </div>
    </div>
@endsection
