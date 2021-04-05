const state = {
  time: '00:00:00.000',
  testLength: 0,
  wpm: 0,
  uncorrectedErrors: 0,
  allErrors: 0,
  accuracy: 0,
  score: 0,
  wordsTypingTimes: null,
  charsStatistics: null,
};
const actions = {
  saveTestResultsInStore({ commit }, testResults) {
    commit('SAVE_TEST_RESULTS_IN_STORE', testResults);
  },
};
const mutations = {
  SAVE_TEST_RESULTS_IN_STORE: (state, testResults) => (state = Object.assign(state, testResults)),
};
const getters = {
  testResults: (state) => state,
};

export default {
  state,
  actions,
  mutations,
  getters,
};
