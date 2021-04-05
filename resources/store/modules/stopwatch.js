const state = {
  stopwatchTime: '00:00:00.000',
};
const actions = {
  setStopwatchTime({ commit }, time) {
    commit('SET_STOPWATCH_TIME', time);
  },
};
const mutations = {
  SET_STOPWATCH_TIME: (state, time) => {
    state.stopwatchTime = time;
  },
};
const getters = {
  stopwatchTime: (state) => state.stopwatchTime,
};

export default {
  state,
  actions,
  mutations,
  getters,
};
