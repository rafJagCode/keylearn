import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '@/layouts/Home';
import Register from '@/layouts/Register';
import Login from '@/layouts/Login';
import Dashboard from '@/layouts/Dashboard';
import Test from '@/layouts/Test';
import PageNotFound from '@/layouts/PageNotFound';
import Statistics from '@/components/dashboard/statistics/Statistics';
import Profiles from '@/components/dashboard/profiles/Profiles';
import GeneralStatistics from '@/components/dashboard/general_statistics/GeneralStatistics';

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
      component: Dashboard,
      children: [
        { path: '', name: 'dashboard', component: GeneralStatistics },
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
    {
      path: '*',
      name: 'page-not-found',
      component: PageNotFound,
    },
  ],
});
router.beforeEach((to, from, next) => {
  if (from.name === to.name) return;
  let routesThatDontNeedAuthentication = ['home', 'login', 'register', 'test', 'page-not-found'];
  if (routesThatDontNeedAuthentication.includes(to.name)) {
    next();
  } else {
    Vue.axios
      .get('/api/authenticated')
      .then(() => {
        next();
      })
      .catch((e) => {
        Vue.$confirm({
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
              next({ name: 'login' });
            }
			else next({name: 'login'})
			throw e;
          },
        });
      });
  }
});
export default router;
