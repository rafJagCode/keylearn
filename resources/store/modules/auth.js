import axios from 'axios';
const state = {
	isUserAuthenticated: false,
	user: null,
	hasSessionExpired: false,
};
const actions = {
	async signIn({ dispatch, commit }, credentials) {
		await axios.get('sanctum/csrf-cookie');
		await axios.post('/api/login', credentials);
		await dispatch('setUserStoreState');
		return await commit('SET_SESSION_EXPIRATION_STATE', false);
	},

	async signOut({ dispatch }) {
		await axios.post('/api/logout');
		return dispatch('setUserStoreState');
	},
	async sessionExpired({ dispatch, commit }) {
		await dispatch('signOut');
		return await commit('SET_SESSION_EXPIRATION_STATE', true);
	},
	setUserStoreState({ commit }) {
		return axios
			.get('/api/user')
			.then((response) => {
				commit('SET_AUTHENTICATED', true);
				commit('SET_USER', response.data);
			})
			.catch(() => {
				commit('SET_AUTHENTICATED', false);
				commit('SET_USER', null);
			});
	},
};
const mutations = {
	SET_AUTHENTICATED: (state, value) => {
		state.isUserAuthenticated = value;
	},
	SET_USER: (state, user) => {
		state.user = user;
	},
	SET_SESSION_EXPIRATION_STATE: (state, sessionState) => {
		state.hasSessionExpired = sessionState;
	},
};
const getters = {
	isUserAuthenticated: (state) => state.isUserAuthenticated,
	user: (state) => state.user,
	hasSessionExpired: (state) => state.hasSessionExpired,
};

export default {
	state,
	actions,
	mutations,
	getters,
};
