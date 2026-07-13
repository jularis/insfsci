<!-- Navigation Header -->
<header>
    <div class="bg-[#00498f] text-white text-xs sm:text-sm">
        <div class="site-container mx-auto flex flex-col gap-3 px-4 py-3 sm:px-6 md:flex-row md:items-center md:justify-between">
            <div class="flex flex-wrap items-center gap-3">
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

            <div class="flex flex-1 items-center gap-5 md:justify-end">
                <form action="{{ route('recherche') }}" method="GET" class="hidden w-full max-w-2xl items-center border-b border-white/20 px-1 py-2 focus-within:border-white md:flex">
                    <input type="search" name="q" placeholder="Recherche..." class="w-full bg-transparent text-base font-semibold text-white outline-none placeholder:text-white/55" />
                    <button type="submit" class="text-white transition hover:text-orange-300">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="bg-white border-b border-slate-200">
        <div class="site-container mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between gap-6 py-8">
                <a href="{{ route('home') }}" class="flex items-center gap-4">
                    <img src="{{ asset('logo.jpg') }}" alt="INSFS" class="h-20 w-auto" />
                    <div class="hidden sm:block">
                        <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[rgb(37_90_48)]">Institut National Supérieur</p>
                        <p class="text-2xl font-bold text-slate-900">Formation Sociale</p>
                    </div>
                </a>

                <div class="hidden items-center gap-7 lg:flex">

                </div>

                <button type="button" id="mobile-menu-btn" class="inline-flex items-center justify-center rounded-md border border-slate-200 p-2 text-[rgb(37_90_48)] hover:bg-slate-100 lg:hidden" aria-label="Ouvrir le menu">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    @if($flashInfos->isNotEmpty())
        <div class="border-y border-slate-200 bg-white text-[rgb(37_90_48)]">
            <div class="flex flex-nowrap items-center">
                <span class="inline-flex h-11 shrink-0 items-center bg-[#ef1b1b] px-8 text-lg font-bold text-white">Flash Infos</span>
                <div class="min-w-0 w-full flex-1 overflow-hidden">
                    <div class="flex gap-16 whitespace-nowrap text-lg text-[rgb(37_90_48)] animate-marquee">
                        @foreach($flashInfos as $info)
                            <a href="{{ filled($info->slug) ? url($info->slug) : route('communiques') }}" class="font-medium transition hover:text-[#ff9700] focus:text-[#ff9700] focus:outline-none">
                                {{ $info->content }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

</header>

<div class="sticky top-0 z-50 bg-white border-b border-slate-200 shadow-sm">
    <div class="site-container mx-auto px-4 sm:px-6">
        <div class="py-3">
            <nav class="hidden items-center justify-center gap-8 text-base font-bold text-[rgb(37_90_48)] lg:flex">
                {!! front_menu('front-menu', 'menu') !!}
            </nav>
        </div>

        <div id="mobile-menu" class="hidden pb-4 lg:hidden">
            <div class="space-y-2 pt-4">
                {!! front_menu('front-menu', 'mobile-menu') !!}
            </div>
        </div>
    </div>
</div>
