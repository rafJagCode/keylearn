const state = {
    finalTime : '00:00:00.000',
    amountOfSigns : 0,
    errors : []
};
const actions = {
    setFinalTime({commit}, payload){
        commit('setFinalTime', payload);
    },
    setAmountOfSigns({commit}){
        commit('setAmountOfSigns', payload);
    },
    setErrors({commit}){
        commit('setErrors', payload);
    },
};
const mutations = {
    setFinalTime: (state, payload) => (state.finalTime=payload),
};
const getters = {
    finalTime: (state) => state.finalTime,
};

export default {
    state,
    actions,
    mutations,
    getters
}