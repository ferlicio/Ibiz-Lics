import { createSSRApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import '../scss/app.scss'
import * as bootstrap from 'bootstrap'

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
  components,
  directives,
})

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    const vueApp = createSSRApp({ render: () => h(App, props) })
    vueApp.mixin({
      data: function () {
        return {};
      },
      computed: {
        pageNotifications () {
          return this.$page.props.notification;
        }
      }
    });
    vueApp.use(plugin, vuetify);
    vueApp.mount(el);
      /* .use(plugin, vuetify)
      .mount(el) */
  },
})