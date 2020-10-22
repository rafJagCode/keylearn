window.Vue = require('vue');

Vue.component('test', require('../components/test').default);

const app = new Vue({
    el: '#app',
});
