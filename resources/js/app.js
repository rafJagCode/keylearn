window.Vue = require('vue');
import VueConfirmDialog from 'vue-confirm-dialog'
import vuetify from '@/plugins/vuetify';
import Route from '@/js/routes';
import App from '@/App';
import store from '@/store';
import axios from 'axios';
import VueAxios from 'vue-axios';

Vue.component('vue-confirm-dialog', VueConfirmDialog.default);
Vue.use(VueConfirmDialog);

axios.defaults.withCredentials = true;
axios.interceptors.response.use(
	function (response) {
		return response;
	},
	function (error) {
		if (error.response.status === 419) {
			Vue.$confirm(
				{
					title: 'Session Expired',
					message: 'You will be redirected to login page',
					button: {
						yes: 'OK',
					},
					/**
					 * Callback Function
					 * @param {Boolean} confirm
					 */
					callback: (confirm) => {
						if (confirm) {
							Route.push('/login');
						}
					},
				});
				return Promise.reject(new Error('CSRF token mismatch'));
		}
		return Promise.reject(error);
	},
);
Vue.use(VueAxios, axios);

store.dispatch('setUserStoreState').then(() => {
	const app = new Vue({
		el: '#app',
		vuetify,
		router: Route,
		store,
		render: (h) => h(App),
	});
});
