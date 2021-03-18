import axios from 'axios';
const state = {
	tests: null,
	speeds: null,
	errors: null,
};
const actions = {
	async setResults({ dispatch, commit, rootGetters }) {
		await axios
			.post('/api/get-profile-results', {
				profile_id: rootGetters.watchedProfile.id,
			})
			.then((res) => {
				commit('SET_TESTS', res.data);
			});
		dispatch('setSpeeds');
		return dispatch('setErrors');
	},
	async setSpeeds({ commit }) {
		let speeds = [];
		state.tests.forEach((test) => {
			speeds.push(test.wpm);
		});
		return commit('SET_SPEEDS', speeds);
	},
	async setErrors({ commit }) {
		let errors = [];
		state.tests.forEach((test) => {
			errors.push(test.all_errors);
		});
		return commit('SET_ERRORS', errors);
	},
};
const mutations = {
	SET_TESTS: (state, tests) => {
		state.tests = tests;
	},
	SET_SPEEDS: (state, speeds) => {
		state.speeds = speeds;
	},
	SET_ERRORS: (state, errors) => {
		state.errors = errors;
	},
};
const getters = {
	tests: (state) => state.tests,
	speeds: (state) => state.speeds,
	errors: (state) => state.errors,
};
export default {
	state,
	actions,
	mutations,
	getters,
};