<script setup>
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
const { news } = defineProps({ news: Array });
</script>

<script>
export default {
  layout: PublicLayout,
};
</script>

<template>
  <Head title="Actualités" />

  <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
    <section class="rounded-3xl bg-white p-10 shadow-sm shadow-slate-200">
      <h1 class="text-4xl font-bold text-slate-900">Actualités</h1>
      <p class="mt-4 text-slate-600">Les dernières informations, activités et événements de l’INSFS.</p>
      <div class="mt-10 space-y-6">
        <div v-for="item in news" :key="item.slug" class="rounded-3xl border border-slate-200 p-6 hover:border-red-600">
          <div class="flex items-center justify-between gap-4 text-slate-500">
            <span>{{ item.date }}</span>
            <span class="text-sm font-semibold text-red-600">Actualité</span>
          </div>
          <h2 class="mt-4 text-2xl font-semibold text-slate-900">{{ item.title }}</h2>
          <p class="mt-3 text-slate-600">{{ item.excerpt }}</p>
        </div>
      </div>
    </section>
  </div>
</template>
