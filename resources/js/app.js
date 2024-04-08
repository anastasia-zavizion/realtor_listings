/*import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.globEager('./Pages/!**!/!*.vue');
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)
    },
})*/

import { createApp, h } from "vue";
import { createInertiaApp } from '@inertiajs/vue3'
import { InertiaProgress } from "@inertiajs/progress";
InertiaProgress.init();

import {ZiggyVue }  from '../../vendor/tightenco/ziggy/dist/index';

createInertiaApp({
    resolve: async (name) => {
        const page = await import(`./Pages/${name}.vue`);
        if (!page.default.layout) {
            page.default.layout = (await import('./Layouts/MainLayout.vue')).default;
        }
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
});
