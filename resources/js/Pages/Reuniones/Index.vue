<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { Link, usePage } from '@inertiajs/vue3';
const props = defineProps({ reuniones: Object });
const page = usePage();
const usuario = page.props.usuario;
</script>

<template>
  <AppLayout :usuario="usuario" :title="'Reuniones'">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-2xl font-semibold">Reuniones</h2>
      <Link v-if="usuario.rol === 'Director'" :href="route('reuniones.create')" class="bg-blue-500 text-white px-3 py-2 rounded">Nueva</Link>
    </div>
    <table class="w-full border-collapse text-sm">
      <thead class="bg-gray-200">
        <tr>
          <th class="p-2">Grupo</th>
          <th class="p-2">Fecha</th>
          <th class="p-2">Tema</th>
          <th class="p-2">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="r in reuniones.data" :key="r.id" class="border-b">
          <td class="p-2">{{ r.grupo.nombre }}</td>
          <td class="p-2">{{ r.fecha }}</td>
          <td class="p-2">{{ r.tema }}</td>
          <td class="p-2">
            <Link :href="route('reuniones.show', r.id)" class="text-blue-500">Ver</Link>
          </td>
        </tr>
      </tbody>
    </table>
  </AppLayout>
</template>