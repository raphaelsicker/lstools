import 'vue-multiselect/dist/vue-multiselect.min.css';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import Vue from 'vue';

import App from './vue/App';
import Router from 'vue-router';
import { routes } from './routes';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import Multiselect from "vue-multiselect";
import store from './vuex';
import VueMask from 'v-mask';

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(Router);
Vue.use(VueMask);

Vue.component('multiselect',Multiselect);

Vue.config.productionTip = true;

const router = new Router({
    routes,
    mode: 'history'
});

new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});
