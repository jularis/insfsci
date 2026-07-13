@extends('layouts.public')

@section('title', 'Contact')

@section('content')
    <div class="space-y-10">
        <section class="overflow-hidden rounded-3xl bg-white shadow-xl shadow-slate-200/70 ring-1 ring-slate-200">
            <div class="grid lg:grid-cols-12">
                <div class="relative overflow-hidden bg-[#00498f] p-8 text-white lg:col-span-5 lg:p-12">
                    <div class="absolute -left-24 -top-24 h-56 w-56 rounded-full bg-white/10"></div>
                    <div class="absolute -bottom-28 right-8 h-64 w-64 rounded-full bg-[#ff9700]/20"></div>

                    <div class="relative">
                        <p class="text-sm font-bold uppercase tracking-[0.24em] text-orange-300">contact</p>
                        <h1 class="mt-5 text-4xl font-extrabold leading-tight sm:text-5xl">Nous joindre</h1>
                        <p class="mt-6 text-lg leading-8 text-white/80">
                            Une question, une demande de partenariat ou un besoin d'information ? L'equipe de l'INSFS vous repondra rapidement.
                        </p>

                        <div class="mt-10 space-y-5">
                            <div class="rounded-2xl bg-white/10 p-5 ring-1 ring-white/15">
                                <p class="text-sm font-bold uppercase tracking-[0.18em] text-orange-200">Adresse</p>
                                <p class="mt-3 text-lg font-semibold">{{ setting('site.address') }}</p>
                            </div>

                            <div class="rounded-2xl bg-white/10 p-5 ring-1 ring-white/15">
                                <p class="text-sm font-bold uppercase tracking-[0.18em] text-orange-200">Service communication</p>
                                <p class="mt-3 text-lg font-semibold">{{ setting('site.communication_service') }}</p>
                            </div>

                            <div class="rounded-2xl bg-white/10 p-5 ring-1 ring-white/15">
                                <p class="text-sm font-bold uppercase tracking-[0.18em] text-orange-200">Email</p>
                                <p class="mt-3 text-lg font-semibold">{{ setting('site.email') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-8 lg:col-span-7 lg:p-12">
                    <p class="text-sm font-bold uppercase tracking-[0.24em] text-[#ef1b1b]">message</p>
                    <h2 class="mt-4 text-3xl font-extrabold text-slate-950">Ecrivez-nous</h2>
                    <p class="mt-4 max-w-2xl leading-8 text-slate-600">
                        Remplissez le formulaire ci-dessous. Les champs nom, email et message sont obligatoires.
                    </p>

                    @if(session('success'))
                        <div class="mt-7 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-medium text-emerald-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mt-7 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
                            <ul class="list-disc space-y-1 pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="mt-8 grid gap-5">
                        @csrf

                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-bold text-slate-700">Nom</label>
                                <input id="name" name="name" type="text" value="{{ old('name') }}" class="mt-2 w-full rounded-md border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-100" />
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-bold text-slate-700">Email</label>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" class="mt-2 w-full rounded-md border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-100" />
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-bold text-slate-700">Message</label>
                            <textarea id="message" name="message" rows="7" class="mt-2 w-full rounded-md border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-100">{{ old('message') }}</textarea>
                        </div>

                        <div class="flex flex-wrap items-center gap-4">
                            <button type="submit" class="inline-flex items-center justify-center rounded-md bg-[#ff9700] px-7 py-3 text-sm font-bold uppercase text-white shadow-lg shadow-orange-200 hover:bg-[#ed8700]">
                                Envoyer le message
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
