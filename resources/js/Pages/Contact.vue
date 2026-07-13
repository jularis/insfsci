<script setup>
import { Head } from '@inertiajs/vue3';
import PublicLayout from '@/Layouts/PublicLayout.vue';
const { flash, errors, csrf_token } = defineProps({ flash: Object, errors: Object, csrf_token: String });
</script>

<script>
export default {
  layout: PublicLayout,
};
</script>

<template>
  <Head title="Contactez-nous" />

  <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
    <section class="rounded-3xl bg-white p-10 shadow-sm shadow-slate-200">
      <h1 class="text-4xl font-bold text-slate-900">Contactez-nous</h1>
      <p class="mt-4 text-slate-600">Une question, une demande d’information ou une candidature ? Envoyez-nous un message.</p>

      <div v-if="flash.success" class="mt-8 rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">{{ flash.success }}</div>

      <form method="post" action="/contactez-nous" class="mt-8 space-y-6">
        <input type="hidden" name="_token" :value="csrf_token" />
        <div>
          <label class="block text-sm font-semibold text-slate-700">Nom</label>
          <input name="name" type="text" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 focus:border-red-600 focus:outline-none" />
          <p v-if="errors.name" class="mt-2 text-sm text-red-600">{{ errors.name }}</p>
        </div>

        <div>
          <label class="block text-sm font-semibold text-slate-700">Email</label>
          <input name="email" type="email" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 focus:border-red-600 focus:outline-none" />
          <p v-if="errors.email" class="mt-2 text-sm text-red-600">{{ errors.email }}</p>
        </div>

        <div>
          <label class="block text-sm font-semibold text-slate-700">Message</label>
          <textarea name="message" rows="6" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 focus:border-red-600 focus:outline-none"></textarea>
          <p v-if="errors.message" class="mt-2 text-sm text-red-600">{{ errors.message }}</p>
        </div>

        <button type="submit" class="inline-flex items-center justify-center rounded-full bg-red-600 px-6 py-3 text-sm font-semibold text-white hover:bg-red-700">Envoyer</button>
      </form>
    </section>
  </div>
</template>
