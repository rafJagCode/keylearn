import Vuex from 'vuex';
import Vue from 'vue';
import count from './modules/count';

Vue.use(Vuex);

export default new Vuex.Store({
    modules:{
        count
    }
})