<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';
const page = usePage();
const usuario = page.props.usuario;
// grupos y docentes deberían ser enviados por el controlador; como ejemplo usamos arrays vacíos
const grupos = page.props.grupos || [];
const docentes = page.props.docentes || [];
const form = useForm({
  grupo_id: '',
  fecha: '',
  tema: '',
  observaciones: '',
  docentes: [],
});
function submit() {
  form.post(route('reuniones.store'));
}
</script>

<template>
  <AppLayout :usuario="usuario" :title="'Nueva reunión'">
    <form @submit.prevent="submit" class="max-w-xl mx-auto">
      <div class="mb-3">
        <label class="block text-sm font-medium mb-1">Grupo</label>
        <select v-model="form.grupo_id" class="w-full border p-2 rounded">
          <option value="">Seleccione</option>
          <option v-for="g in grupos" :value="g.id" :key="g.id">{{ g.nombre }}</option>
        </select>
        <div v-if="form.errors.grupo_id" class="text-red-500 text-sm">{{ form.errors.grupo_id }}</div>
      </div>
      <div class="mb-3">
        <label class="block text-sm font-medium mb-1">Fecha</label>
        <input v-model="form.fecha" type="datetime-local" class="w-full border p-2 rounded" />
        <div v-if="form.errors.fecha" class="text-red-500 text-sm">{{ form.errors.fecha }}</div>
      </div>
      <div class="mb-3">
        <label class="block text-sm font-medium mb-1">Tema</label>
        <input v-model="form.tema" type="text" class="w-full border p-2 rounded" />
        <div v-if="form.errors.tema" class="text-red-500 text-sm">{{ form.errors.tema }}</div>
      </div>
      <div class="mb-3">
        <label class="block text-sm font-medium mb-1">Observaciones</label>
        <textarea v-model="form.observaciones" class="w-full border p-2 rounded"></textarea>
      </div>
      <div class="mb-3">
        <label class="block text-sm font-medium mb-1">Docentes invitados</label>
        <select v-model="form.docentes" multiple class="w-full border p-2 rounded">
          <option v-for="d in docentes" :value="d.id" :key="d.id">{{ d.name }}</option>
        </select>
        <div v-if="form.errors.docentes" class="text-red-500 text-sm">{{ form.errors.docentes }}</div>
      </div>
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded" :disabled="form.processing">Guardar</button>
    </form>
  </AppLayout>
</template>