<script setup>
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
const { establishments } = defineProps({ establishments: Array });
</script>

<script>
export default {
  layout: PublicLayout,
};
</script>

<template>
  <Head title="Établissements" />

  <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
    <section class="rounded-3xl bg-white p-10 shadow-sm shadow-slate-200">
      <h1 class="text-4xl font-bold text-slate-900">Nos établissements</h1>
      <p class="mt-6 text-slate-600">Trois écoles spécialisées pour préparer les futurs éducateurs et assistants sociaux en Côte d’Ivoire.</p>
      <div class="mt-10 grid gap-6 lg:grid-cols-3">
        <div v-for="item in establishments" :key="item.slug" class="rounded-3xl border border-slate-200 p-6 shadow-sm">
          <h2 class="text-2xl font-semibold text-slate-900">{{ item.name }}</h2>
          <p class="mt-3 text-slate-600">{{ item.excerpt }}</p>
          <div class="mt-6 space-y-3 text-slate-600">
            <p><span class="font-semibold text-slate-800">Niveaux requis :</span> {{ item.requirements }}</p>
            <p><span class="font-semibold text-slate-800">Objectifs :</span> {{ item.objectives }}</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
