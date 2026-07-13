@extends('layouts.public')

@section('title', 'Accueil')

@section('hero')
    @if($sliders->isNotEmpty())

        <section class="relative h-[520px] w-full overflow-hidden bg-[#00498f]" id="hero-slider">
            <div class="flex h-full transition-transform duration-700 ease-out" id="hero-slider-track">
                @foreach($sliders as $slider)
                    <section class="relative min-w-full overflow-hidden">
                        <div class="absolute inset-0 bg-cover bg-center opacity-95" style="background-image: linear-gradient(110deg, rgba(0,73,143,0.10), rgba(15,23,42,0.10)), url('{{ $slider->image_url }}');"></div>
                        <div class="absolute inset-0 bg-black/30"></div>
                        <div class="relative flex h-full items-center justify-center px-6 text-center">
                            <div>
                                @if($slider->title)
                                    <p class="mb-5 text-lg font-bold uppercase tracking-[0.28em] text-orange-300">{{ $slider->title }}</p>
                                @endif
                                <h1 class="max-w-5xl text-4xl font-extrabold leading-tight text-white drop-shadow-lg sm:text-5xl lg:text-6xl">
                                    {{ $slider->body }}
                                </h1>
                            </div>
                        </div>
                    </section>
                @endforeach
            </div>

            <button id="hero-slider-prev" type="button" class="absolute left-5 top-1/2 z-10 hidden h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-white/85 text-2xl font-bold text-[rgb(37_90_48)] shadow-lg transition hover:bg-white md:inline-flex" aria-label="Slide précédent">
                &lsaquo;
            </button>
            <button id="hero-slider-next" type="button" class="absolute right-5 top-1/2 z-10 hidden h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-white/85 text-2xl font-bold text-[rgb(37_90_48)] shadow-lg transition hover:bg-white md:inline-flex" aria-label="Slide suivant">
                &rsaquo;
            </button>

            <div class="absolute bottom-6 left-1/2 z-10 flex -translate-x-1/2 items-center gap-3" aria-label="Navigation du slider">
                @foreach($sliders as $slider)
                    <button type="button" class="hero-slider-dot h-3 w-3 rounded-full {{ $loop->first ? 'bg-white' : 'bg-white/50' }}" aria-label="Aller au slide {{ $loop->iteration }}"></button>
                @endforeach
            </div>
        </section>
    @endif
@endsection

@section('content')
    <section class="relative overflow-hidden rounded-3xl bg-[#f6f9fd] shadow-xl shadow-slate-200/70 ring-1 ring-slate-200">
        <div class="absolute right-0 top-0 h-40 w-40 rounded-bl-full bg-[#ff9700]/15"></div>
        <div class="grid lg:grid-cols-12">
            <div class="relative overflow-hidden bg-[#00498f] p-8 text-white lg:col-span-5 lg:p-12">
                <div class="absolute -left-24 -top-24 h-56 w-56 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-28 right-8 h-64 w-64 rounded-full bg-[#ff9700]/20"></div>

                <div class="relative">
                    <p class="inline-flex rounded-full bg-white/10 px-4 py-2 text-sm font-bold uppercase tracking-[0.22em] text-orange-200">bienvenue à l'INSFS</p>
                    <h1 class="mt-7 text-4xl font-extrabold leading-tight sm:text-5xl">Institut National Supérieur de Formation Sociale</h1>
                    <div class="mt-7 flex min-h-56 w-full max-w-xl items-center justify-center rounded-2xl bg-white p-6 shadow-2xl shadow-blue-950/20 ring-1 ring-white/20">
                        <img src="{{ asset('logo.jpg') }}" alt="Logo de l'INSFS" class="max-h-44 w-auto max-w-full object-contain" loading="lazy">
                    </div>
                    <div class="mt-6 max-w-xl space-y-4 text-lg leading-8 text-white/80">
                        <p>L'Institut National de Formation Sociale est un Établissement Public à caractère administratif ; il est doté de la personnalité morale et de l'autonomie financière.</p>
                        <p>L'Institut National de Formation Sociale est membre de l'Association pour l'Enseignement Social en Afrique (AESA), et membre de l'Association Internationale des Ecoles de Service Social (AIESS).</p>
                        <p>L'enseignement post-baccalauréat qu'il dispense devrait lui conférer le statut de grande école.</p>
                    </div>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('institut.show', 'presentation') }}" class="inline-flex items-center justify-center rounded-md bg-[#ff9700] px-6 py-3 text-sm font-bold uppercase text-white shadow-lg shadow-blue-950/20 hover:bg-[#ed8700]">
                            En savoir plus
                        </a>
                        <a href="{{ route('contact') }}" class="inline-flex items-center justify-center rounded-md border border-white/30 px-6 py-3 text-sm font-bold uppercase text-white hover:bg-white hover:text-[rgb(37_90_48)]">
                            Nous contacter
                        </a>
                    </div>

                </div>
            </div>

            <div class="relative p-8 lg:col-span-7 lg:p-10">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-[0.24em] text-[#ef1b1b]">services</p>
                        <h2 class="mt-3 text-3xl font-extrabold text-slate-950">Un accompagnement complet</h2>
                    </div>
                    <p class="max-w-md text-sm leading-6 text-slate-600">Des services d'encadrement pédagogique, de recherche et de documentation adaptés aux besoins des étudiants et des professionnels.</p>
                </div>

                <div class="mt-8 grid gap-4 sm:grid-cols-2">
                    @forelse($services as $service)
                        <a href="{{ route('services.show', $service['slug']) }}" class="group relative block overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-[#00498f]/30 hover:shadow-xl hover:shadow-slate-200">
                            <div class="absolute inset-x-0 top-0 h-1 bg-[#ff9700]"></div>
                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-sm font-extrabold text-[rgb(37_90_48)] group-hover:bg-[#00498f] group-hover:text-white">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </div>
                            <h3 class="mt-5 text-xl font-extrabold leading-snug text-slate-950 group-hover:text-[rgb(37_90_48)]">{{ $service['name'] }}</h3>
                            <p class="mt-4 text-sm leading-6 text-slate-600">{{ $service['excerpt'] }}</p>
                            @if(!empty($service['intro'] ?? $service['description'] ?? null))
                                <p class="mt-3 text-sm leading-6 text-slate-500">{{ $service['intro'] ?? $service['description'] }}</p>
                            @endif
                            <span class="mt-5 inline-flex items-center gap-2 text-sm font-bold uppercase text-[#ff9700]">
                                Lire le détail <span aria-hidden="true">+</span>
                            </span>
                        </a>
                    @empty
                        <p class="rounded-2xl border border-dashed border-slate-300 bg-white p-6 text-sm leading-6 text-slate-500 sm:col-span-2">
                            Aucun service publié pour le moment.
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section class="mt-10 space-y-8">
        <div class="grid gap-8 lg:grid-cols-12">
            <div class="overflow-hidden rounded-3xl bg-[#00498f] text-white shadow-xl shadow-blue-900/10 lg:col-span-4">
                <div class="p-8">
                    <p class="text-sm font-bold uppercase tracking-[0.24em] text-orange-300">chiffres clés</p>
                    <h2 class="mt-4 text-3xl font-extrabold leading-tight">L'INSFS en quelques repères</h2>
                    <p class="mt-4 text-sm leading-6 text-white/75">Une institution de formation sociale ancrée dans l'accompagnement, la pratique et le développement des compétences.</p>
                </div>

                <div class="grid border-t border-white/10 sm:grid-cols-2">
                    @foreach($stats as $stat)
                        <div class="border-white/10 p-6 odd:border-r sm:border-b [&:nth-last-child(-n+2)]:sm:border-b-0">
                            <p class="text-4xl font-extrabold tracking-tight text-white">{{ $stat['value'] }}</p>
                            <p class="mt-2 text-sm font-semibold text-white/75">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="rounded-3xl bg-white p-8 shadow-xl shadow-slate-200/70 ring-1 ring-slate-200 lg:col-span-8">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-[0.24em] text-[#ef1b1b]">actualités</p>
                        <h2 class="mt-3 text-3xl font-extrabold text-slate-950">Dernières nouvelles de l'institut</h2>
                    </div>
                    <a href="{{ route('actualites') }}" class="inline-flex items-center justify-center rounded-md bg-[#ff9700] px-5 py-3 text-sm font-bold uppercase text-white shadow-sm shadow-orange-200 hover:bg-[#ed8700]">
                        Tout voir
                    </a>
                </div>

                @php
                    $newsImages = [
                        asset('news-directeur.svg'),
                        asset('news-formation.svg'),
                        asset('news-portes-ouvertes.svg'),
                    ];
                @endphp

                <div class="mt-8 grid gap-5 md:grid-cols-3">
                    @forelse($news as $item)
                        <article class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:border-[#00498f]/30 hover:shadow-xl hover:shadow-slate-200">
                            <div class="absolute inset-x-0 top-0 h-1 bg-[#ff9700]"></div>
                            <a href="{{ route('actualites.show', $item['slug']) }}" class="block h-40 overflow-hidden bg-slate-100">
                                <img src="{{ $item['image'] ?: $newsImages[$loop->index % count($newsImages)] }}" alt="{{ $item['title'] }}" class="h-full w-full object-cover transition duration-300 group-hover:scale-105" loading="lazy">
                            </a>
                            <div class="p-6">
                                <p class="inline-flex rounded-full bg-blue-50 px-3 py-1 text-sm font-bold text-[rgb(37_90_48)]">{{ $item['date'] }}</p>
                                <h3 class="mt-5 text-xl font-extrabold leading-snug text-slate-950 group-hover:text-[rgb(37_90_48)]">{{ $item['title'] }}</h3>
                                <p class="mt-4 text-sm leading-6 text-slate-600">{{ $item['excerpt'] }}</p>
                                <a href="{{ route('actualites.show', $item['slug']) }}" class="mt-6 inline-flex items-center gap-2 text-sm font-bold uppercase text-[#ff9700]">
                                    Lire plus <span aria-hidden="true">+</span>
                                </a>
                            </div>
                        </article>
                    @empty
                        <p class="rounded-2xl border border-dashed border-slate-300 bg-white p-6 text-sm leading-6 text-slate-500 md:col-span-3">
                            Aucune actualité publiée pour le moment.
                        </p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="rounded-3xl bg-white p-8 shadow-xl shadow-slate-200/70 ring-1 ring-slate-200">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.24em] text-[#ef1b1b]">écoles</p>
                    <h2 class="mt-3 text-3xl font-extrabold text-slate-950">Nos écoles de formation</h2>
                </div>
                <a href="{{ route('etablissements') }}" class="inline-flex items-center justify-center rounded-md border border-[#00498f] px-5 py-3 text-sm font-bold uppercase text-[rgb(37_90_48)] hover:bg-[#00498f] hover:text-white">
                    Voir les établissements
                </a>
            </div>

            <div class="mt-8 grid gap-6 lg:grid-cols-3">
                @foreach($establishments as $establishment)
                    <article class="group relative overflow-hidden rounded-2xl bg-[#f6f9fd] p-7 ring-1 ring-slate-200 transition hover:-translate-y-1 hover:bg-white hover:shadow-xl hover:shadow-slate-200">
                        <div class="absolute right-0 top-0 h-24 w-24 rounded-bl-full bg-[#ff9700]/15 transition group-hover:bg-[#ff9700]/25"></div>
                        <div class="relative flex h-14 w-14 items-center justify-center rounded-2xl bg-[#00498f] text-lg font-extrabold text-white shadow-lg shadow-blue-900/20">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </div>
                        <h3 class="relative mt-6 text-xl font-extrabold leading-snug text-slate-950 group-hover:text-[rgb(37_90_48)]">{{ $establishment['name'] }}</h3>
                        <p class="relative mt-4 text-sm leading-6 text-slate-600">{{ $establishment['excerpt'] }}</p>
                        <a href="{{ route('etablissements.show', $establishment['slug']) }}" class="relative mt-6 inline-flex items-center gap-2 text-sm font-bold uppercase text-[#ff9700]">
                            Découvrir <span aria-hidden="true">+</span>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
