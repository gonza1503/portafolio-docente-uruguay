<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { Link, usePage } from '@inertiajs/vue3';
const props = defineProps({ planificaciones: Object });
const page = usePage();
const usuario = page.props.usuario;
</script>

<template>
  <AppLayout :usuario="usuario" :title="'Planificaciones'">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-2xl font-semibold">Planificaciones</h2>
      <Link :href="route('planificaciones.create')" class="bg-blue-500 text-white px-3 py-2 rounded">Nueva</Link>
    </div>
    <table class="w-full border-collapse text-sm">
      <thead class="bg-gray-200">
        <tr>
          <th class="p-2">Grupo</th>
          <th class="p-2">Fecha</th>
          <th class="p-2">Objetivo</th>
          <th class="p-2">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="plan in planificaciones.data" :key="plan.id" class="border-b">
          <td class="p-2">{{ plan.grupo.nombre }}</td>
          <td class="p-2">{{ plan.fecha }}</td>
          <td class="p-2">{{ plan.objetivo.slice(0, 30) }}…</td>
          <td class="p-2">
            <Link :href="route('planificaciones.edit', plan.id)" class="text-blue-500">Editar</Link>
          </td>
        </tr>
      </tbody>
    </table>
  </AppLayout>
</template>