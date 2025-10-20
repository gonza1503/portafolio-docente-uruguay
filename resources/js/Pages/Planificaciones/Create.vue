<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';
const page = usePage();
const usuario = page.props.usuario;
// Podría recibirse una lista de grupos asignados al docente desde el backend
const grupos = page.props.grupos || [];
const form = useForm({
  grupo_id: '',
  objetivo: '',
  contenido: '',
  estrategias: '',
  evaluacion_prevista: '',
  fecha: '',
  duracion_min: '',
});
function submit() {
  form.post(route('planificaciones.store'));
}
</script>

<template>
  <AppLayout :usuario="usuario" :title="'Nueva Planificación'">
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
        <label class="block text-sm font-medium mb-1">Objetivo</label>
        <textarea v-model="form.objetivo" class="w-full border p-2 rounded"></textarea>
        <div v-if="form.errors.objetivo" class="text-red-500 text-sm">{{ form.errors.objetivo }}</div>
      </div>
      <div class="mb-3">
        <label class="block text-sm font-medium mb-1">Contenido</label>
        <textarea v-model="form.contenido" class="w-full border p-2 rounded"></textarea>
        <div v-if="form.errors.contenido" class="text-red-500 text-sm">{{ form.errors.contenido }}</div>
      </div>
      <div class="mb-3">
        <label class="block text-sm font-medium mb-1">Estrategias</label>
        <textarea v-model="form.estrategias" class="w-full border p-2 rounded"></textarea>
      </div>
      <div class="mb-3">
        <label class="block text-sm font-medium mb-1">Evaluación prevista</label>
        <textarea v-model="form.evaluacion_prevista" class="w-full border p-2 rounded"></textarea>
      </div>
      <div class="mb-3">
        <label class="block text-sm font-medium mb-1">Fecha</label>
        <input v-model="form.fecha" type="date" class="w-full border p-2 rounded" />
        <div v-if="form.errors.fecha" class="text-red-500 text-sm">{{ form.errors.fecha }}</div>
      </div>
      <div class="mb-3">
        <label class="block text-sm font-medium mb-1">Duración (minutos)</label>
        <input v-model="form.duracion_min" type="number" class="w-full border p-2 rounded" />
      </div>
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded" :disabled="form.processing">Guardar</button>
    </form>
  </AppLayout>
</template>