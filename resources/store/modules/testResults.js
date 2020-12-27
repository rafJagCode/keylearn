const state = {
    finalTime : '00:00:00.000',
    amountOfSigns : 0,
    errors : 0,
};
const actions = {
    setFinalTime({commit}, payload){
        commit('setFinalTime', payload);
    },
    setAmountOfSigns({commit}, payload){
        commit('setAmountOfSigns', payload);
    },
    setErrors({commit}, payload){
        commit('setErrors', payload);
    },
};
const mutations = {
    setFinalTime: (state, payload) => (state.finalTime=payload),
    setAmountOfSigns: (state, payload) =>(state.amountOfSigns=payload),
    setErrors: (state, payload) =>(state.errors=payload),

};
const getters = {
    finalTime: (state) => state.finalTime,
    amountOfSigns: (state) => state.amountOfSigns,
    errors: (state) => state.errors,
};

export default {
    state,
    actions,
    mutations,
    getters
}