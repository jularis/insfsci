<script setup>
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
</script>

<script>
export default {
  layout: PublicLayout,
};
</script>

<template>
  <Head title="L'institut" />

  <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
    <section class="rounded-3xl bg-white p-10 shadow-sm shadow-slate-200">
      <h1 class="text-4xl font-bold text-slate-900">L’institut</h1>
      <p class="mt-6 text-lg leading-8 text-slate-600">L’Institut National Supérieur de Formation Sociale est un établissement public à caractère administratif doté de la personnalité morale et de l’autonomie financière.</p>
      <div class="mt-10 grid gap-8 lg:grid-cols-2">
        <div>
          <h2 class="text-2xl font-semibold text-slate-900">Notre mission</h2>
          <p class="mt-4 text-slate-600">Former des professionnels compétents en travail social, en accompagnement éducatif et en formation continue, dans le respect de l’éthique et de la rigueur académique.</p>
        </div>
        <div>
          <h2 class="text-2xl font-semibold text-slate-900">Nos valeurs</h2>
          <ul class="mt-4 space-y-3 text-slate-600">
            <li>Excellence professionnelle</li>
            <li>Éthique sociale</li>
            <li>Esprit de solidarité</li>
            <li>Ouverture régionale</li>
          </ul>
        </div>
      </div>
      <div class="mt-10 rounded-3xl bg-slate-50 p-8">
        <h3 class="text-2xl font-semibold text-slate-900">Affiliations</h3>
        <p class="mt-4 text-slate-600">L’INSFS est membre de l’Association pour l’Enseignement Social en Afrique (AESA) et de l’Association Internationale des Écoles de Service Social (AIESS).</p>
      </div>
    </section>
  </div>
</template>
