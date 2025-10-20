<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { usePage } from '@inertiajs/vue3';
const props = defineProps({ reunion: Object });
const page = usePage();
const usuario = page.props.usuario;
</script>

<template>
  <AppLayout :usuario="usuario" :title="'Reunión'">
    <h2 class="text-2xl font-semibold mb-4">Reunión – {{ reunion.grupo.nombre }}</h2>
    <p><strong>Fecha:</strong> {{ reunion.fecha }}</p>
    <p><strong>Tema:</strong> {{ reunion.tema }}</p>
    <p><strong>Observaciones:</strong> {{ reunion.observaciones ?? '-' }}</p>
    <h3 class="text-xl font-bold mt-4 mb-2">Docentes Invitados</h3>
    <ul class="list-disc ml-6">
      <li v-for="doc in reunion.docentes" :key="doc.id">{{ doc.name }}</li>
    </ul>
  </AppLayout>
</template>