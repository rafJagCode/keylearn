window.Vue = require('vue');
import vuetify from '@/plugins/vuetify';
import Route from '@/js/routes';
import App from '@/App';
import store from '@/store';
// Vue.component('test', require('@/components/test').default);

const app = new Vue({
    el: '#app',
    vuetify,
    router: Route,
    store,
    render: h => h(App)
});
