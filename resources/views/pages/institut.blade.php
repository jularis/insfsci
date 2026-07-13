@extends('layouts.public')

@section('title', "L'institut")

@section('content')
    <article id="presentation" class="rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
        <p class="text-sm lowercase tracking-[0.24em] text-red-600">à propos de l’INSFS</p>
        <h1 class="mt-4 text-4xl font-bold text-slate-900">Institut National Supérieur de Formation Sociale</h1>
        <p class="mt-6 text-lg leading-8 text-slate-600">L’INSFS forme des cadres et des acteurs du travail social, avec une pédagogie basée sur l’engagement, l’insertion professionnelle et la recherche appliquée.</p>
        <div class="mt-10 grid gap-8 lg:grid-cols-2">
            <div class="rounded-3xl bg-slate-50 p-6">
                <h2 class="text-xl font-semibold text-slate-900">Notre mission</h2>
                <p class="mt-4 text-slate-600 leading-7">Former des professionnels capables d’accompagner les familles, les personnes en situation de vulnérabilité et les collectivités, en privilégiant l’éthique, la solidarité et l’innovation sociale.</p>
            </div>
            <div class="rounded-3xl bg-slate-50 p-6">
                <h2 class="text-xl font-semibold text-slate-900">Notre vision</h2>
                <p class="mt-4 text-slate-600 leading-7">Être un institut de référence pour la formation sociale en Afrique francophone, reconnu pour la qualité de ses programmes et la pertinence de ses recherches.</p>
            </div>
        </div>
    </article>

    <section id="directeur" class="mt-10 rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
        <h2 class="text-2xl font-semibold text-slate-900">Directeur</h2>
        <p class="mt-4 text-slate-600 leading-7">Le Directeur de l’INSFS assure la coordination générale des activités pédagogiques, administratives et de recherche. Il représente l’institut auprès des partenaires nationaux et internationaux.</p>
    </section>

    <section id="sous-directeurs" class="mt-10 rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
        <h2 class="text-2xl font-semibold text-slate-900">Sous-directeurs</h2>
        <p class="mt-4 text-slate-600 leading-7">Les sous-directeurs appuient le Directeur dans l’organisation des formations, le suivi des examens et la mise en œuvre des projets de développement institutionnel.</p>
    </section>

    <section id="sous-directions" class="mt-10 rounded-3xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
        <h2 class="text-2xl font-semibold text-slate-900">Sous-directions</h2>
        <p class="mt-4 text-slate-600 leading-7">Les sous-directions de l’INSFS couvrent la scolarité, la recherche, la communication et l’appui aux étudiants afin de garantir un fonctionnement administratif fluide.</p>
    </section>
@endsection
