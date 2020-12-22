const state = {
    hasTestEnded:false
};
const actions = {
    endTest({commit}){
        commit('endTest');
    },
};
const mutations = {
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