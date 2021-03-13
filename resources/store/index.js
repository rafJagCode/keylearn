import Vuex from 'vuex';
import Vue from 'vue';
import testResults from './modules/testResults';
import test from './modules/test';
import auth from './modules/auth';
import statistics from './modules/statistics';
import stopwatch from './modules/stopwatch';
import profiles from './modules/profiles';

Vue.use(Vuex);

export default new Vuex.Store({
	modules: {
		testResults,
		test,
		auth,
		statistics,
		stopwatch,
		profiles,
	},
});
