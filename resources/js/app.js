import 'vue-multiselect/dist/vue-multiselect.min.css';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'vue-swatches/dist/vue-swatches.css';

import Vue from 'vue';
import App from './vue/App'
import Router from 'vue-router'
import { routes } from './routes'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import Multiselect from "vue-multiselect"
import store from './vuex'
import VueMask from 'v-mask'
import VSwatches from 'vue-swatches'
import GmapVue from 'gmap-vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import { faPrint, faLocationPin, faLocationDot } from '@fortawesome/free-solid-svg-icons'

library.add(faPrint)
library.add(faLocationPin)
library.add(faLocationDot)

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(Router)
Vue.use(VueMask)
Vue.use(GmapVue, {
    load: {
        key: 'AIzaSyAlUit4tpB1aNGRzNEQtLXf_umBlkthRQQ',
        libraries: 'places',
        installComponents: true
    }
})

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('multiselect', Multiselect)
Vue.component('swatches', VSwatches)

Vue.config.productionTip = true

const router = new Router({
    routes,
    mode: 'history'
})

new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
})
