const INITIAL_STATE = () => {
    return{
        isTestRunning: true,
        isTestActivated: false,
        text: '',
        typed: '',
        signs: [],
    }
};
const state = {
    isTestRunning: true,
    isTestActivated: false,
    text: '',
    typed: '',
    signs: [],
};
const actions = {
    testEnded({commit}){
        commit('testEnded');
    },
    testStarted({commit}){
        commit('testStarted');
    },
    activateTest({commit}){
        commit('activateTest');
    },
    deactivateTest({commit}){
        commit('deactivateTest');
    },
    resetTestData({commit}){
        commit('resetTestData');
    },
    updateTyped({commit}, typed){
        commit('updateTyped', typed);
    },
    updateText({commit}, text){
        commit('updateText', text);
    },
    updateSigns({commit}, signs){
        commit('updateSigns', signs);
    },

};
const mutations = {
    testEnded: (state) => (state.isTestRunning = false),
    testStarted: (state) => (state.isTestRunning = true),
    activateTest: (state) => (state.isTestActivated = true),
    deactivateTest: (state) => (state.isTestActivated = false),
    resetTestData: (state) => (Object.assign(state, INITIAL_STATE())),
    updateTyped: (state, typed) => (state.typed = typed),
    updateText: (state, text) => (state.text = text),
    updateSigns: (state, signs) => (state.signs = signs),
};
const getters = {
    isTestRunning: (state) => state.isTestRunning,
    isTestActivated: (state) => state.isTestActivated,
    typed: (state) => state.typed,
    text: (state) => state.text,
    signs: (state) => state.signs,
};

export default {
    state,
    actions,
    mutations,
    getters
}