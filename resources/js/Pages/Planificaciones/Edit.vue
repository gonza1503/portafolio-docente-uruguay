<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';
const props = defineProps({ planificacion: Object });
const page = usePage();
const usuario = page.props.usuario;
const form = useForm({
  objetivo: props.planificacion.objetivo,
  contenido: props.planificacion.contenido,
  estrategias: props.planificacion.estrategias,
  evaluacion_prevista: props.planificacion.evaluacion_prevista,
  fecha: props.planificacion.fecha,
  duracion_min: props.planificacion.duracion_min,
});
function submit() {
  form.put(route('planificaciones.update', props.planificacion.id));
}
</script>

<template>
  <AppLayout :usuario="usuario" :title="'Editar planificación'">
    <form @submit.prevent="submit" class="max-w-xl mx-auto">
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
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded" :disabled="form.processing">Actualizar</button>
    </form>
  </AppLayout>
</template>