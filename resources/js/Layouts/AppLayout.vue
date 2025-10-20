<template>
  <div class="min-h-screen flex bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md hidden md:block">
      <div class="px-4 py-2 text-lg font-bold border-b">Portafolio Docente</div>
      <nav class="mt-4">
        <Link :href="route('dashboard')" class="block px-4 py-2 hover:bg-gray-200" :class="{ 'font-bold': isRoute('dashboard') }">Inicio</Link>
        <Link v-if="can('Director')" :href="route('centros.index')" class="block px-4 py-2 hover:bg-gray-200" :class="{ 'font-bold': isRoute('centros.index') }">Centros</Link>
        <Link v-if="can('Director')" :href="route('grupos.index')" class="block px-4 py-2 hover:bg-gray-200" :class="{ 'font-bold': isRoute('grupos.index') }">Grupos</Link>
        <Link v-if="can('Docente')" :href="route('grupos.mis')" class="block px-4 py-2 hover:bg-gray-200" :class="{ 'font-bold': isRoute('grupos.mis') }">Mis Grupos</Link>
        <Link v-if="can('Director')" :href="route('reportes.index')" class="block px-4 py-2 hover:bg-gray-200" :class="{ 'font-bold': isRoute('reportes.index') }">Reportes</Link>
      </nav>
    </aside>
    <!-- Main content -->
    <div class="flex-1 flex flex-col">
      <header class="bg-white shadow px-4 py-2 flex justify-between items-center">
        <h1 class="text-xl font-semibold">{{ title }}</h1>
        <div class="text-sm">{{ usuario.nombre }} ({{ usuario.rol }})</div>
      </header>
      <main class="p-4">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

const page = usePage();
const usuario = computed(() => page.props.usuario || { nombre: '', rol: '' });
const title = computed(() => page.props.title || '');

function isRoute(name) {
  return page.url.startsWith(route(name));
}

function can(role) {
  return usuario.value.rol === role;
}
</script>

<style scoped>
a {
  text-decoration: none;
}
</style>