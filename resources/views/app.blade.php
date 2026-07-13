<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @php($pageTitle = trim($__env->yieldContent('title')))
        <title>{{ $pageTitle !== '' ? $pageTitle . ' | INSFS' : 'INSFS' }}</title>
        <link rel="icon" href="{{ asset('public/logo.jpg') }}" type="image/jpeg">
        <link rel="shortcut icon" href="{{ asset('public/logo.jpg') }}" type="image/jpeg">
        <link rel="apple-touch-icon" href="{{ asset('public/logo.jpg') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('public/site/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('public/site/css/custom.css') }}">
        <script src="{{ asset('public/site/js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900">
        @include('components.navigation')

        @yield('hero')

        <main class="site-container mx-auto px-4 sm:px-6 py-10">
            @yield('content')
        </main>

        <footer class="bg-[#00498f] text-white">
            <div class="relative h-80 overflow-hidden border-b border-white/10 bg-slate-200">
                <iframe
                    class="h-full w-full"
                    src="https://maps.google.com/maps?q={{ urlencode(setting('site.address')) }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Carte de localisation INSFS"
                ></iframe>
                <a href="#" class="absolute bottom-5 right-6 inline-flex h-14 w-14 items-center justify-center rounded-t-md bg-[#00498f] text-2xl font-bold text-white shadow-lg" aria-label="Retour en haut">⌃</a>
            </div>

            <div class="site-container mx-auto grid gap-12 px-4 py-14 sm:px-6 lg:grid-cols-3">
                <div>
                    <h2 class="text-3xl font-extrabold">Nous joindre</h2>
                    <div class="mt-7 space-y-5 text-lg font-semibold">
                        <p class="flex items-start gap-4">
                            <svg class="mt-1 h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M12 21s7-4.7 7-11a7 7 0 1 0-14 0c0 6.3 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                            <span>{{ setting('site.address') }}</span>
                        </p>
                        <p class="flex items-start gap-4">
                            <svg class="mt-1 h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M4 6h16v12H4z"/><path d="m4 7 8 6 8-6"/></svg>
                            <a href="mailto:{{ setting('site.email') }}" class="hover:text-[#ff9700]">{{ setting('site.email') }}</a>
                        </p>
                        <p class="flex items-start gap-4">
                            <svg class="mt-1 h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.2 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.91.33 1.8.63 2.65a2 2 0 0 1-.45 2.11L8 9.77a16 16 0 0 0 6.23 6.23l1.29-1.29a2 2 0 0 1 2.11-.45c.85.3 1.74.51 2.65.63A2 2 0 0 1 22 16.92Z"/></svg>
                            <span>{{ setting('site.communication_service') }}</span>
                        </p>
                        <a href="{{ route('contact') }}" class="inline-flex items-center gap-3 pt-3 font-extrabold text-[#ff9700] hover:text-orange-300">
                            <span aria-hidden="true">+</span> Contacts des services
                        </a>
                    </div>
                </div>

                <div>
                    <h2 class="text-3xl font-extrabold">Liens utiles</h2>
                    <div class="mt-7 space-y-5 text-lg font-semibold">
                        <a href="#" class="flex items-center gap-4 hover:text-[#ff9700]"><span aria-hidden="true">↗</span> Inscription &amp; Reinscription</a>
                        <a href="#" class="flex items-center gap-4 hover:text-[#ff9700]"><span aria-hidden="true">↗</span> Concours directs INSFS</a>
                        <a href="{{ route('communiques') }}" class="flex items-center gap-4 text-white/55 hover:text-white"><span aria-hidden="true">▣</span> Communiques 2026</a>
                    </div>
                </div>

                <div>
                    <h2 class="text-3xl font-extrabold">Nos applications</h2>
                    <div class="mt-7 grid gap-5 text-lg font-semibold sm:grid-cols-2">
                        <a href="#" class="flex items-center gap-4 hover:text-[#ff9700]"><span aria-hidden="true">↗</span> Espace etudiant</a>
                        <a href="#" class="flex items-center gap-4 hover:text-[#ff9700]"><span aria-hidden="true">↗</span> Archives</a>
                        <a href="#" class="flex items-center gap-4 hover:text-[#ff9700]"><span aria-hidden="true">↗</span> Scolarite</a>
                        <a href="#" class="flex items-center gap-4 hover:text-[#ff9700]"><span aria-hidden="true">↗</span> Ressources</a>
                    </div>
                    @if(filled(setting('site.linkedin_url')) || filled(setting('site.facebook_url')) || filled(setting('site.instagram_url')) || filled(setting('site.youtube_url')) || filled(setting('site.twitter_url')))
                    <div class="mt-9 flex flex-wrap items-center gap-3 text-lg font-extrabold">
                        <span>Suivez-nous ↗</span>
                        @if(filled(setting('site.linkedin_url')))
                        <a href="{{ setting('site.linkedin_url') }}" target="_blank" rel="noopener noreferrer" class="inline-flex h-9 w-9 items-center justify-center rounded bg-[#0a7bbb] text-sm" aria-label="LinkedIn">in</a>
                        @endif
                        @if(filled(setting('site.facebook_url')))
                        <a href="{{ setting('site.facebook_url') }}" target="_blank" rel="noopener noreferrer" class="inline-flex h-9 w-9 items-center justify-center rounded bg-[#2f7de1] text-sm" aria-label="Facebook">f</a>
                        @endif
                        @if(filled(setting('site.instagram_url')))
                        <a href="{{ setting('site.instagram_url') }}" target="_blank" rel="noopener noreferrer" class="inline-flex h-9 w-9 items-center justify-center rounded bg-[#f15a40] text-sm" aria-label="Instagram">ig</a>
                        @endif
                        @if(filled(setting('site.youtube_url')))
                        <a href="{{ setting('site.youtube_url') }}" target="_blank" rel="noopener noreferrer" class="inline-flex h-9 w-9 items-center justify-center rounded bg-[#f01818] text-sm" aria-label="YouTube">yt</a>
                        @endif
                        @if(filled(setting('site.twitter_url')))
                        <a href="{{ setting('site.twitter_url') }}" target="_blank" rel="noopener noreferrer" class="inline-flex h-9 w-9 items-center justify-center rounded bg-slate-950 text-sm" aria-label="X / Twitter">X</a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>

            <div class="border-t border-white/15 bg-[#003f7b] px-4 py-5 text-center text-sm font-semibold text-white/85 sm:px-6">
                <p>Copyright © {{ date('Y') }} INSFS. Tous droits réservés.</p>
            </div>
        </footer>
        @stack('scripts')
    </body>
</html>
