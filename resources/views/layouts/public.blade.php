@extends('app')

@section('page-content')
        <header class="sticky top-0 z-50 shadow-sm">
            <div class="bg-green-900 text-green-50 text-xs sm:text-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 flex flex-col gap-3 md:flex-row md:items-center md:justify-between py-2">
                    <div class="flex flex-wrap items-center gap-3 text-slate-300">
                        <span class="inline-flex items-center gap-2 text-slate-400">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2Zm0 18.5a8.5 8.5 0 1 1 8.5-8.5 8.51 8.51 0 0 1-8.5 8.5Zm1-12.5h-2v6h2Zm0 8h-2v2h2Z"/></svg>
                            <span class="hidden sm:inline">Suivez-nous</span>
                        </span>
                        @if(filled(setting('site.linkedin_url')))
                        <a href="{{ setting('site.linkedin_url') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center rounded-full w-9 h-9 bg-green-950/70 hover:bg-white hover:text-green-900 transition text-green-50" aria-label="LinkedIn">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4.98 3.5A2.48 2.48 0 0 0 2.5 5.98a2.48 2.48 0 0 0 2.48 2.48A2.48 2.48 0 0 0 7.46 5.98 2.48 2.48 0 0 0 4.98 3.5Zm.02 4.5H3V20h4V8h-2ZM9 8h4v1.65c.56-1.04 1.93-1.95 3.97-1.95 4.24 0 5.04 2.8 5.04 6.45V20h-4v-5.7c0-1.36-.02-3.11-1.89-3.11-1.89 0-2.18 1.48-2.18 3.01V20h-4V8Z"/></svg>
                        </a>
                        @endif
                        @if(filled(setting('site.facebook_url')))
                        <a href="{{ setting('site.facebook_url') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center rounded-full w-9 h-9 bg-green-950/70 hover:bg-white hover:text-green-900 transition text-green-50" aria-label="Facebook">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12a10 10 0 1 0-11.5 9.86v-6.99h-2.2V12h2.2V9.8c0-2.17 1.29-3.37 3.28-3.37.95 0 1.95.17 1.95.17v2.15h-1.1c-1.08 0-1.42.67-1.42 1.35V12h2.42l-.39 2.87h-2.03v6.99A10 10 0 0 0 22 12Z"/></svg>
                        </a>
                        @endif
                        @if(filled(setting('site.instagram_url')))
                        <a href="{{ setting('site.instagram_url') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center rounded-full w-9 h-9 bg-green-950/70 hover:bg-white hover:text-green-900 transition text-green-50" aria-label="Instagram">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 7a5 5 0 1 0 5 5 5 5 0 0 0-5-5Zm0 8.2a3.2 3.2 0 1 1 3.2-3.2A3.21 3.21 0 0 1 12 15.2Zm4.95-8.95a1.18 1.18 0 1 1-1.18-1.18 1.18 1.18 0 0 1 1.18 1.18Zm3.05 1.2c0-.8-.65-1.45-1.45-1.45h-2.3a1.58 1.58 0 0 0-1.57 1.57v2.3A1.58 1.58 0 0 0 15.25 11h2.3c.8 0 1.45-.65 1.45-1.45Zm-1.5 6.3a4.95 4.95 0 1 1-4.95-4.95A4.95 4.95 0 0 1 18.5 13.75ZM12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2Zm0 18.2A8.2 8.2 0 1 1 20.2 12 8.2 8.2 0 0 1 12 20.2Z"/></svg>
                        </a>
                        @endif
                        @if(filled(setting('site.youtube_url')))
                        <a href="{{ setting('site.youtube_url') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center rounded-full w-9 h-9 bg-green-950/70 hover:bg-white hover:text-green-900 transition text-green-50" aria-label="YouTube">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21.8 8s-.2-1.5-.8-2.2c-.8-.8-1.7-.8-2.1-.9C15.7 4.7 12 4.7 12 4.7h0s-3.7 0-6.9.2c-.4 0-1.4.1-2.1.9C2.4 6.5 2.2 8 2.2 8S2 9.8 2 11.5v1c0 1.7.2 3.5.2 3.5s.2 1.5.8 2.2c.8.8 1.9.8 2.4.9 1.7.1 7.1.2 7.1.2s3.7 0 6.9-.2c.4 0 1.4-.1 2.1-.9.6-.7.8-2.2.8-2.2s.2-1.8.2-3.5v-1c0-1.7-.2-3.5-.2-3.5ZM9.8 14.4V9.6l5 2.4-5 2.4Z"/></svg>
                        </a>
                        @endif
                        @if(filled(setting('site.twitter_url')))
                        <a href="{{ setting('site.twitter_url') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center rounded-full w-9 h-9 bg-green-950/70 text-sm font-bold text-green-50 transition hover:bg-white hover:text-green-900" aria-label="X / Twitter">X</a>
                        @endif
                    </div>
                    <div class="flex items-center gap-3 justify-between md:justify-end">
                        <form action="#" method="GET" class="hidden md:flex items-center rounded-full bg-green-950 border border-green-800 px-3 py-1 focus-within:ring-2 focus-within:ring-red-500">
                            <input type="search" name="search" placeholder="Recherche" class="bg-transparent outline-none text-slate-100 placeholder:text-slate-500 text-sm" />
                            <button type="submit" class="text-slate-300 hover:text-white transition">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="bg-white border-b border-slate-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6">
                    <div class="flex items-center justify-between h-24 py-4">
                        <a href="{{ route('home') }}" class="flex items-center gap-3">
                            <img src="{{ asset('logo.jpg') }}" alt="INSFS" class="h-16 w-auto rounded-md shadow-sm" />
                            <div class="hidden sm:block">
                                <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Institut National Supérieur</p>
                                <p class="text-xl font-semibold text-slate-900">INSFS</p>
                            </div>
                        </a>

                        <button class="lg:hidden p-2 text-slate-700 rounded-md border border-slate-200 hover:bg-slate-100" id="mobile-menu-btn" aria-label="Ouvrir le menu mobile">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center justify-between py-3 bg-slate-50">
                        <nav class="hidden lg:flex items-center gap-8 text-sm font-medium text-slate-700">
                           {!! front_menu('front-menu', 'menu') !!}
                        </nav>


                    </div>

                    <div id="mobile-menu" class="hidden lg:hidden pb-4">
                        <div class="space-y-2 pt-4">
                            {!! front_menu('front-menu', 'mobile-menu') !!}
                        </div>
                    </div>
                </div>
            </div>
            @if($flashInfos->isNotEmpty())
                <div class="bg-red-50 border-t border-b border-red-200 text-red-900">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3">
                        <div class="flex flex-nowrap items-center gap-3">
                            <span class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-red-700">Flash infos</span>
                            <div class="min-w-0 w-full flex-1 overflow-hidden">
                                <div class="flex gap-6 whitespace-nowrap text-sm text-slate-800 animate-marquee">
                                    @foreach($flashInfos as $info)
                                        <a href="{{ filled($info->slug) ? url($info->slug) : route('communiques') }}" class="font-medium transition hover:text-red-900 focus:text-red-900 focus:outline-none">
                                            {{ $info->content }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </header>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 py-10">
            @yield('page-content')
        </main>
@endsection
