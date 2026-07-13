<script setup>
import { Link } from '@inertiajs/vue3';

const nav = [
  { label: 'Accueil', route: 'home' },
  { label: "L'institut", route: 'institut' },
  { label: 'Etablissements', route: 'etablissements' },
  { label: 'Services', route: 'services' },
  { label: 'Galerie', route: 'galerie' },
  { label: 'Communiques', route: 'communiques' },
  { label: 'Actualites', route: 'actualites' },
  { label: 'Contact', route: 'contact' },
];
</script>

<template>
    <div class="min-h-screen bg-slate-50 text-slate-800">
        <header class="border-b border-slate-200 bg-white">
            <div class="bg-[#00498f] text-white">
                <div class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-4 py-3 sm:px-6 lg:px-8">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-md bg-[#0a7bbb] font-bold">in</span>
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-md bg-[#2f7de1] font-bold">f</span>
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-md bg-[#f15a40] font-bold">ig</span>
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-md bg-[#f01818] font-bold">yt</span>
                    </div>
                    <div class="hidden max-w-2xl flex-1 items-center border-b border-white/20 py-2 md:flex">
                        <input type="search" placeholder="Recherche..." class="w-full bg-transparent text-base font-semibold text-white outline-none placeholder:text-white/55" />
                    </div>
                    <div class="flex items-center gap-3 rounded-xl border border-black/30 px-6 py-3">
                        <span class="inline-flex h-4 w-7 items-center justify-center bg-blue-700 text-[8px] font-bold text-white">FR</span>
                        <span class="inline-flex h-4 w-7 items-center justify-center bg-red-600 text-[8px] font-bold text-white">EN</span>
                    </div>
                </div>
            </div>

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between py-8">
                    <Link href="/" class="flex items-center gap-4">
                        <div class="flex h-20 w-20 items-center justify-center rounded-md bg-[#00498f] text-2xl font-bold text-white">
                            IN
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-slate-900">INSFS</p>
                            <p class="text-sm text-[rgb(37_90_48)]">Institut National Superieur de Formation Sociale</p>
                        </div>
                    </Link>

                    <nav class="hidden items-center gap-7 text-lg font-bold text-[rgb(37_90_48)] lg:flex">
                        <Link
                            v-for="item in nav"
                            :key="item.route"
                            :href="route(item.route)"
                            class="hover:text-[#ff9700]"
                        >
                            {{ item.label }}
                        </Link>
                    </nav>

                    <div class="hidden items-center gap-3 lg:flex">
                        <Link href="/contactez-nous" class="inline-flex items-center rounded-md bg-[#ff9700] px-6 py-3 text-sm font-bold uppercase text-white shadow-sm shadow-orange-200 hover:bg-[#ed8700]">
                            Inscription
                        </Link>
                    </div>
                </div>
            </div>
        </header>

        <main class="py-10">
            <slot />
        </main>

        <footer class="bg-[#00498f] text-white">
            <div class="relative h-80 overflow-hidden border-b border-white/10 bg-slate-200">
                <iframe
                    class="h-full w-full"
                    src="https://maps.google.com/maps?q=Abidjan%20Cote%20d'Ivoire&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Carte de localisation INSFS"
                ></iframe>
                <a href="#" class="absolute bottom-5 right-6 inline-flex h-14 w-14 items-center justify-center rounded-t-md bg-[#00498f] text-2xl font-bold text-white shadow-lg">⌃</a>
            </div>

            <div class="mx-auto grid max-w-7xl gap-12 px-4 py-14 sm:px-6 lg:grid-cols-3 lg:px-8">
                <div>
                    <h2 class="text-3xl font-extrabold">Nous joindre</h2>
                    <div class="mt-7 space-y-5 text-lg font-semibold">
                        <p>⌖ Abidjan, Cote d'Ivoire</p>
                        <p>✉ 25 BP 2257 - Abidjan 25</p>
                        <p>☎ +225 27 2240 5580</p>
                        <Link href="/contactez-nous" class="inline-flex pt-3 font-extrabold text-[#ff9700]">+ Contacts des services</Link>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-extrabold">Liens utiles</h2>
                    <div class="mt-7 space-y-5 text-lg font-semibold">
                        <a href="#" class="block hover:text-[#ff9700]">↗ Inscription &amp; Reinscription</a>
                        <a href="#" class="block hover:text-[#ff9700]">↗ Concours directs INSFS</a>
                        <a href="#" class="block hover:text-[#ff9700]">↗ Offres d'emploi</a>
                        <Link href="/actualites" class="block text-white/55 hover:text-white">▣ Communiques 2026</Link>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-extrabold">Nos applications</h2>
                    <div class="mt-7 grid gap-5 text-lg font-semibold sm:grid-cols-2">
                        <a href="#" class="hover:text-[#ff9700]">↗ Espace etudiant</a>
                        <a href="#" class="hover:text-[#ff9700]">↗ Archives</a>
                        <a href="#" class="hover:text-[#ff9700]">↗ Scolarite</a>
                        <a href="#" class="hover:text-[#ff9700]">↗ Ressources</a>
                    </div>
                    <div class="mt-9 flex flex-wrap items-center gap-3 text-lg font-extrabold">
                        <span>Suivez-nous ↗</span>
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded bg-[#0a7bbb] text-sm">in</span>
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded bg-[#2f7de1] text-sm">f</span>
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded bg-[#f15a40] text-sm">ig</span>
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded bg-[#f01818] text-sm">yt</span>
                    </div>
                </div>
            </div>
            <div class="border-t border-white/15 bg-[#003f7b] px-4 py-5 text-center text-sm font-semibold text-white/85 sm:px-6">
                <p>Copyright © 2026 INSFS. Tous droits réservés.</p>
            </div>
        </footer>
    </div>
</template>
