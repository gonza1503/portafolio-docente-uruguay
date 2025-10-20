<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';
const props = defineProps({ centro: Object });
const page = usePage();
const usuario = page.props.usuario;
const form = useForm({
  nombre: props.centro.nombre,
  direccion: props.centro.direccion,
});

function submit() {
  form.put(route('centros.update', props.centro.id));
}
</script>

<template>
  <AppLayout :usuario="usuario" :title="'Editar centro'">
    <form @submit.prevent="submit" class="max-w-lg mx-auto">
      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Nombre</label>
        <input v-model="form.nombre" type="text" class="w-full border p-2 rounded" />
        <div v-if="form.errors.nombre" class="text-red-500 text-sm">{{ form.errors.nombre }}</div>
      </div>
      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Dirección</label>
        <input v-model="form.direccion" type="text" class="w-full border p-2 rounded" />
        <div v-if="form.errors.direccion" class="text-red-500 text-sm">{{ form.errors.direccion }}</div>
      </div>
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded" :disabled="form.processing">Actualizar</button>
    </form>
  </AppLayout>
</template>