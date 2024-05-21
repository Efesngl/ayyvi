import './bootstrap';
import "../css/app.css"
import * as bootstrap from "bootstrap"
import "bootstrap/dist/css/bootstrap.min.css"
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { ZiggyVue } from 'ziggy-js';
import { autoAnimatePlugin } from '@formkit/auto-animate/vue'
import "dropzone/dist/dropzone.css"
window.bootstrap=bootstrap
createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: false })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    
    const app=createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .use(autoAnimatePlugin)
      .mount(el)
  },
})