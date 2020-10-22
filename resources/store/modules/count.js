const state = {
    count: 0
};
const actions = {
    incrementCount({commit}){
        commit('incrementCount', 1);
    },
    decrementCount({commit}){
        commit('decrementCont', 1);
    }
};
const mutations = {
    incrementCount: (state, amount) => (state.count+=amount),
    decrementCont: (state, amount) => (state.count-=amount)
};
const getters = {
    count: (state) => state.count,
};

export default {
    state,
    actions,
    mutations,
    getters
}