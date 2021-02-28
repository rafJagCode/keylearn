import Vuex from 'vuex';
import Vue from 'vue';
import testResults from './modules/testResults';
import test from './modules/test';
import auth from './modules/auth';
import statistics from './modules/statistics';

Vue.use(Vuex);

export default new Vuex.Store({
    modules:{
        testResults,
        test,
        auth,
        statistics
    }
})