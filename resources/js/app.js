import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { InertiaProgress } from '@inertiajs/progress';
import '../css/app.css';

// Inicialización de Inertia
createInertiaApp({
    resolve: async name => {
        const pages = import.meta.glob('./Pages/**/*.vue');
        return (await pages[`./Pages/${name}.vue`]()).default;
    },
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .use(plugin)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });