import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '@/layouts/Home';
import Register from '@/layouts/Register';
import Login from '@/layouts/Login';
import Dashboard from '@/layouts/Dashboard';
import Test from '@/layouts/Test';
import Statistics from '@/components/dashboard/statistics/Statistics';
import Profiles from '@/components/dashboard/profiles/Profiles';

Vue.use(VueRouter);

const router = new VueRouter({
	mode: 'history',
	routes: [
		{
			path: '/',
			name: 'home',
			component: Home,
		},
		{
			path: '/register',
			name: 'register',
			component: Register,
		},
		{
			path: '/login',
			name: 'login',
			component: Login,
		},
		{
			path: '/dashboard',
			name: 'dashboard',
			component: Dashboard,
			beforeEnter: (to, from, next) => {
				Vue.axios
					.get('api/authenticated')
					.then(() => {
						next();
					})
					.catch(() => {
						return next({
							name: 'login',
						});
					});
			},
			children: [
				{
					name: 'statistics',
					path: 'statistics',
					component: Statistics,
				},
				{
					name: 'profiles',
					path: 'profiles',
					component: Profiles,
				},
			],
		},
		{
			path: '/test',
			name: 'test',
			component: Test,
		},
	],
});

export default router;
