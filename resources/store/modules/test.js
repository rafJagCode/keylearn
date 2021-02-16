const state = {
    hasTestEnded:false
};
const actions = {
    startTest({commit}){
        commit('startTest');
    },
    endTest({commit}){
        commit('endTest');
    },
};
const mutations = {
    startTest: (state) => (state.hasTestEnded=false),
    endTest: (state) => (state.hasTestEnded=true),
};
const getters = {
    hasTestEnded: (state) => state.hasTestEnded,
};

export default {
    state,
    actions,
    mutations,
    getters
}