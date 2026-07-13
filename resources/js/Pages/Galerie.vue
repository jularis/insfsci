<script setup>
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
const { gallery } = defineProps({ gallery: Array });
</script>

<script>
export default {
  layout: PublicLayout,
};
</script>

<template>
  <Head title="Galerie" />

  <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
    <section class="rounded-3xl bg-white p-10 shadow-sm shadow-slate-200">
      <h1 class="text-4xl font-bold text-slate-900">Galerie</h1>
      <p class="mt-4 text-slate-600">Les temps forts de l’INSFS : cérémonies, soutenances et événements académiques.</p>
      <div class="mt-10 grid gap-6 md:grid-cols-3">
        <div v-for="album in gallery" :key="album.slug" class="rounded-3xl overflow-hidden border border-slate-200 bg-slate-50">
          <div class="h-44 bg-slate-200"></div>
          <div class="p-6">
            <h2 class="text-xl font-semibold text-slate-900">{{ album.title }}</h2>
            <p class="mt-3 text-slate-600">{{ album.excerpt }}</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
