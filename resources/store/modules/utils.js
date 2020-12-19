const state = {
    isShaking:false
};
const actions = {
    turnShakingOn({commit}){
        commit('turnShakingOn');
    },
    turnShakingOff({commit}){
        commit('turnShakingOff');
    }
};
const mutations = {
    turnShakingOn: (state) => (state.isShaking=true),
    turnShakingOff: (state) => (state.isShaking=false)
};
const getters = {
    isShaking: (state) => state.isShaking,
};

export default {
    state,
    actions,
    mutations,
    getters
}