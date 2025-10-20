<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { usePage } from '@inertiajs/vue3';
const props = defineProps({ grupo: Object });
const page = usePage();
const usuario = page.props.usuario;
</script>

<template>
  <AppLayout :usuario="usuario" :title="`Grupo ${grupo.nombre}`">
    <h2 class="text-2xl font-semibold mb-4">{{ grupo.nombre }} – {{ grupo.centro.nombre }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div>
        <h3 class="text-xl font-bold mb-2">Alumnos</h3>
        <ul class="list-disc ml-6">
          <li v-for="al in grupo.alumnos" :key="al.id">{{ al.nombre }} ({{ al.cedula }})</li>
        </ul>
      </div>
      <div>
        <h3 class="text-xl font-bold mb-2">Docentes</h3>
        <ul class="list-disc ml-6">
          <li v-for="doc in grupo.docentes" :key="doc.id">{{ doc.name }} – {{ doc.pivot.materia }}</li>
        </ul>
      </div>
    </div>
  </AppLayout>
</template>