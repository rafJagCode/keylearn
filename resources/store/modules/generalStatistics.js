import axios from 'axios';

const state = {
  generalStatistics: null,
};
const getters = {
  generalStatistics: (state) => state.generalStatistics,
};
const mutations = {
  SET_GENERAL_STATISTICS(state, generalStatistics) {
    state.generalStatistics = generalStatistics;
  },
};
const actions = {
  async setGeneralStatistics({ commit }) {
    let res = await axios.post('/api/get-general-statistics');
    let generalStatistics = res.data;
    commit('SET_GENERAL_STATISTICS', generalStatistics);
  },
};
export default {
  state,
  getters,
  mutations,
  actions,
};
