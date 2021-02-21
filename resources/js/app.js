window.Vue = require('vue');
import vuetify from '@/plugins/vuetify';
import Route from '@/js/routes';
import App from '@/App';
import store from '@/store';
import axios from 'axios'
import VueAxios from 'vue-axios'
// Vue.component('test', require('@/components/test').default);
axios.defaults.withCredentials = true;
Vue.use(VueAxios, axios);
store.dispatch('setUserStoreState').then(() => {
    const app = new Vue({
        el: '#app',
        vuetify,
        router: Route,
        store,
        render: h => h(App)
    });
})
