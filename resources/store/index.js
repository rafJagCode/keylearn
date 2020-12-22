import Vuex from 'vuex';
import Vue from 'vue';
import count from './modules/count';
import utils from './modules/utils';
import stopwatch from './modules/stopwatch';
import test from './modules/test';
import testResults from './modules/testResults';

Vue.use(Vuex);

export default new Vuex.Store({
    modules:{
        count,
        utils,
        stopwatch,
        test,
        testResults
    }
})