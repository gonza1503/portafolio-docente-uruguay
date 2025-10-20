<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { usePage } from '@inertiajs/vue3';
const props = defineProps({ grupos: Array });
const page = usePage();
const usuario = page.props.usuario;
</script>

<template>
  <AppLayout :usuario="usuario" :title="'Reportes'">
    <h2 class="text-2xl font-semibold mb-4">Reportes de Promedios</h2>
    <div v-for="g in grupos" :key="g.grupo" class="mb-6">
      <h3 class="text-xl font-bold mb-2">Grupo {{ g.grupo }}</h3>
      <table class="w-full border-collapse text-sm">
        <thead class="bg-gray-200">
          <tr>
            <th class="p-2">Docente</th>
            <th class="p-2">Materia</th>
            <th class="p-2">Promedio</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="p in g.promedios" :key="p.docente" class="border-b">
            <td class="p-2">{{ p.docente }}</td>
            <td class="p-2">{{ p.materia }}</td>
            <td class="p-2">{{ p.promedio ?? '-' }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
</template>