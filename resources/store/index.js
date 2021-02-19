import Vuex from 'vuex';
import Vue from 'vue';
import testResults from './modules/testResults';
import test from './modules/test';

Vue.use(Vuex);

export default new Vuex.Store({
    modules:{
        testResults,
        test
    }
})