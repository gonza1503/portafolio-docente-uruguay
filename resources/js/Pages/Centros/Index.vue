<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { Link, usePage } from '@inertiajs/vue3';
const props = defineProps({ centros: Object });
const page = usePage();
const usuario = page.props.usuario;
</script>

<template>
  <AppLayout :usuario="usuario" :title="'Centros'">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-2xl font-semibold">Centros</h2>
      <Link :href="route('centros.create')" class="bg-blue-500 text-white px-3 py-2 rounded">Nuevo centro</Link>
    </div>
    <table class="w-full border-collapse">
      <thead>
        <tr class="bg-gray-200">
          <th class="p-2">Nombre</th>
          <th class="p-2">Dirección</th>
          <th class="p-2">Director</th>
          <th class="p-2">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="centro in centros.data" :key="centro.id" class="border-b">
          <td class="p-2">{{ centro.nombre }}</td>
          <td class="p-2">{{ centro.direccion ?? '-' }}</td>
          <td class="p-2">{{ centro.director?.name ?? '-' }}</td>
          <td class="p-2">
            <Link :href="route('centros.edit', centro.id)" class="text-blue-500 mr-2">Editar</Link>
            <Link as="button" method="delete" :href="route('centros.destroy', centro.id)" class="text-red-500">Eliminar</Link>
          </td>
        </tr>
      </tbody>
    </table>
  </AppLayout>
</template>