const state = {
    isClockStarted:false
};
const actions = {
    startClock({commit}){
        commit('startClock');
    },
    stopClock({commit}){
        commit('stopClock');
    },
};
const mutations = {
    startClock: (state) => (state.isClockStarted=true),
    stopClock: (state) => (state.isClockStarted=false),
};
const getters = {
    isClockStarted: (state) => state.isClockStarted,
};

export default {
    state,
    actions,
    mutations,
    getters
}