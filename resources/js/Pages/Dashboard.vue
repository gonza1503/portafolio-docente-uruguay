<script setup>
import AppLayout from '../Layouts/AppLayout.vue';
import { usePage } from '@inertiajs/vue3';
const props = defineProps({ data: Object });
const page = usePage();
const usuario = page.props.usuario;
</script>

<template>
  <AppLayout :usuario="usuario" :title="'Inicio'">
    <div>
      <h2 class="text-2xl font-semibold mb-4">Bienvenido/a</h2>
      <div v-if="usuario.rol === 'Director'">
        <h3 class="text-xl font-bold mb-2">Promedios generales por grupo</h3>
        <table class="w-full border-collapse">
          <thead>
            <tr class="bg-gray-200 text-left">
              <th class="p-2">Grupo</th>
              <th class="p-2">Promedio</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in data.promedios" :key="item.grupo" class="border-b">
              <td class="p-2">{{ item.grupo }}</td>
              <td class="p-2">{{ item.promedio ?? '-' }}</td>
            </tr>
          </tbody>
        </table>
        <h3 class="text-xl font-bold mt-4 mb-2">Próximas reuniones</h3>
        <ul class="list-disc ml-6">
          <li v-for="reunion in data.reuniones" :key="reunion.fecha + reunion.grupo">
            {{ reunion.fecha }} – {{ reunion.grupo }} – {{ reunion.tema }}
          </li>
        </ul>
      </div>
      <div v-else-if="usuario.rol === 'Docente'">
        <h3 class="text-xl font-bold mb-2">Mis grupos</h3>
        <ul class="list-disc ml-6">
          <li v-for="g in data.grupos" :key="g.id">
            {{ g.nombre }} ({{ g.centro }})
          </li>
        </ul>
        <h3 class="text-xl font-bold mt-4 mb-2">Próximas reuniones</h3>
        <ul class="list-disc ml-6">
          <li v-for="reunion in data.reuniones" :key="reunion.fecha + reunion.grupo">
            {{ reunion.fecha }} – {{ reunion.grupo }} – {{ reunion.tema }}
          </li>
        </ul>
      </div>
    </div>
  </AppLayout>
</template>