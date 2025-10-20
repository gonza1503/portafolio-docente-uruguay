<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { Link, usePage } from '@inertiajs/vue3';
const props = defineProps({ evaluaciones: Object });
const page = usePage();
const usuario = page.props.usuario;
</script>

<template>
  <AppLayout :usuario="usuario" :title="'Evaluaciones'">
    <h2 class="text-2xl font-semibold mb-4">Evaluaciones</h2>
    <table class="w-full border-collapse text-sm">
      <thead class="bg-gray-200">
        <tr>
          <th class="p-2">Alumno</th>
          <th class="p-2">Grupo</th>
          <th class="p-2">Docente</th>
          <th class="p-2">Periodo</th>
          <th class="p-2">Actividad</th>
          <th class="p-2">Nota</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="eva in evaluaciones.data" :key="eva.id" class="border-b">
          <td class="p-2">{{ eva.alumno.nombre }}</td>
          <td class="p-2">{{ eva.alumno.grupo.nombre }}</td>
          <td class="p-2">{{ eva.docente.name }}</td>
          <td class="p-2">{{ eva.periodo }}</td>
          <td class="p-2">{{ eva.actividad ?? '-' }}</td>
          <td class="p-2">{{ eva.nota }}</td>
        </tr>
      </tbody>
    </table>
  </AppLayout>
</template>