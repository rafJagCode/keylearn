import Vuex from 'vuex';
import Vue from 'vue';
import testResults from './modules/testResults';

Vue.use(Vuex);

export default new Vuex.Store({
    modules:{
        testResults
    }
})