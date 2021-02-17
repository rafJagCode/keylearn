const INITIAL_STATE = {
    time : '00:00:00.000',
    testLenght : 0,
    errors : 0,
    accuracy: 0,
    score: 0,
    wpm: 0,
};
const state = {
    time : '00:00:00.000',
    testLenght : 0,
    errors : 0,
    accuracy: 0,
    score: 0,
    wpm: 0,
};
const actions = {
    resetTestResults({commit}){
        commit('resetTestResults');
    },
    saveTestResults({commit}, testResults){
        commit('saveTestResults', testResults);
    }
};
const mutations = {
    resetTestResults: (state) => (state = INITIAL_STATE),
    saveTestResults: (state, testResults) =>(state=testResults)
};
const getters = {
    testResults: (state) => state
};

export default {
    state,
    actions,
    mutations,
    getters
}