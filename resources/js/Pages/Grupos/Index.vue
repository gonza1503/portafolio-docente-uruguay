<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { Link, usePage } from '@inertiajs/vue3';
const props = defineProps({ grupos: Object });
const page = usePage();
const usuario = page.props.usuario;
</script>

<template>
  <AppLayout :usuario="usuario" :title="'Grupos'">
    <h2 class="text-2xl font-semibold mb-4">Grupos</h2>
    <table class="w-full border-collapse">
      <thead class="bg-gray-200">
        <tr>
          <th class="p-2">Grupo</th>
          <th class="p-2">Centro</th>
          <th class="p-2">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="grupo in grupos.data" :key="grupo.id" class="border-b">
          <td class="p-2">{{ grupo.nombre }}</td>
          <td class="p-2">{{ grupo.centro.nombre }}</td>
          <td class="p-2">
            <Link :href="route('grupos.show', grupo.id)" class="text-blue-500">Ver</Link>
          </td>
        </tr>
      </tbody>
    </table>
  </AppLayout>
</template>