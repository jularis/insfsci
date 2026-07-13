@extends('app')

@section('content')
    <section class="overflow-hidden rounded-3xl bg-white shadow-xl shadow-slate-200/70 ring-1 ring-slate-200">
        <div class="grid min-h-[460px] lg:grid-cols-12">
            <div class="relative overflow-hidden bg-[#00498f] p-8 text-white lg:col-span-5 lg:p-12">
                <div class="absolute -left-24 -top-24 h-56 w-56 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-28 right-8 h-64 w-64 rounded-full bg-[#ff9700]/20"></div>

                <div class="relative flex h-full flex-col justify-center">
                    <p class="text-sm font-bold uppercase tracking-[0.28em] text-orange-300">Erreur 404</p>
                    <h1 class="mt-5 text-5xl font-extrabold leading-tight sm:text-6xl">Contenu introuvable</h1>
                    <p class="mt-6 max-w-lg text-lg leading-8 text-white/80">
                        Le contenu demandé est introuvable ou a été déplacé.
                    </p>
                </div>
            </div>

            <div class="flex flex-col justify-center p-8 lg:col-span-7 lg:p-12">
                <p class="text-sm font-bold uppercase tracking-[0.24em] text-[#ef1b1b]">Navigation</p>
                <h2 class="mt-4 text-3xl font-extrabold text-slate-950">Retrouver votre chemin</h2>
                <p class="mt-5 max-w-2xl leading-8 text-slate-600">
                    Vous pouvez revenir à l'accueil, consulter les actualités ou nous contacter si vous cherchiez une information précise.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center rounded-md bg-[#ff9700] px-6 py-3 text-sm font-bold uppercase text-white shadow-lg shadow-orange-200 hover:bg-[#ed8700]">
                        Accueil
                    </a>
                    <a href="{{ route('actualites') }}" class="inline-flex items-center justify-center rounded-md border border-[#00498f] px-6 py-3 text-sm font-bold uppercase text-[rgb(37_90_48)] hover:bg-[#00498f] hover:text-white">
                        Actualités
                    </a>
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center rounded-md border border-slate-300 px-6 py-3 text-sm font-bold uppercase text-slate-700 hover:bg-slate-100">
                        Contact
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
