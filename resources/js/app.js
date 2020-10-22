window.Vue = require('vue');
import vuetify from '@/plugins/vuetify';

Vue.component('test', require('@/components/test').default);

const app = new Vue({
    vuetify,
    el: '#app',
});
