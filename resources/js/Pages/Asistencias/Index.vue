<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { Link, usePage } from '@inertiajs/vue3';
const props = defineProps({ asistencias: Object });
const page = usePage();
const usuario = page.props.usuario;
</script>

<template>
  <AppLayout :usuario="usuario" :title="'Asistencias'">
    <h2 class="text-2xl font-semibold mb-4">Asistencias</h2>
    <table class="w-full border-collapse text-sm">
      <thead class="bg-gray-200">
        <tr>
          <th class="p-2">Alumno</th>
          <th class="p-2">Grupo</th>
          <th class="p-2">Fecha</th>
          <th class="p-2">Estado</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="asistencia in asistencias.data" :key="asistencia.id" class="border-b">
          <td class="p-2">{{ asistencia.alumno.nombre }}</td>
          <td class="p-2">{{ asistencia.alumno.grupo.nombre }}</td>
          <td class="p-2">{{ asistencia.fecha }}</td>
          <td class="p-2">{{ asistencia.estado }}</td>
        </tr>
      </tbody>
    </table>
  </AppLayout>
</template>