<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
const { services } = defineProps({ services: Array });
</script>

<script>
export default {
  layout: PublicLayout,
};
</script>

<template>
  <Head title="Services" />

  <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
    <section class="rounded-3xl bg-white p-10 shadow-sm shadow-slate-200">
      <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
        <div>
          <h1 class="text-4xl font-bold text-slate-900">Nos services</h1>
          <p class="mt-4 text-slate-600">Des services conçus pour accompagner les étudiants, coordonner les stages et développer la recherche.</p>
        </div>
        <Link href="/contactez-nous" class="inline-flex items-center rounded-full bg-red-600 px-6 py-3 text-sm font-semibold text-white hover:bg-red-700">Demande de renseignement</Link>
      </div>
      <div class="mt-10 grid gap-6 md:grid-cols-2">
        <div v-for="service in services" :key="service.slug" class="rounded-3xl border border-slate-200 p-6 hover:border-red-600">
          <h2 class="text-2xl font-semibold text-slate-900">{{ service.name }}</h2>
          <p class="mt-4 text-slate-600">{{ service.excerpt }}</p>
          <p class="mt-4 text-slate-500">{{ service.description }}</p>
        </div>
      </div>
    </section>
  </div>
</template>
