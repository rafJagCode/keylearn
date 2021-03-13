import axios from 'axios';
const state = {
	profiles: null,
	watchedProfile: null,
	selectedProfile: null,
};
const actions = {
	async setProfiles({ commit, rootGetters }) {
		await axios
			.post('/api/get-profiles', {
				id: rootGetters.user.id,
			})
			.then((res) => {
				let profiles = res.data;
				commit('SET_PROFILES', profiles);
				let selectedProfile = profiles.find(
					(obj) => obj.id === rootGetters.user.selected_profile_id,
				);
				commit('SET_WATCHED_PROFILE', selectedProfile);
				commit('SET_SELECTED_PROFILE', selectedProfile);
			});
	},
	setWatchedProfile({ commit }, watchedProfile) {
		commit('SET_WATCHED_PROFILE', watchedProfile);
	},
	setSelectedProfile({ commit }, selectedProfile) {
		commit('SET_SELECTED_PROFILE', selectedProfile);
	},
};
const mutations = {
	SET_PROFILES: (state, profiles) => {
		state.profiles = profiles;
	},
	SET_WATCHED_PROFILE: (state, watchedProfile) => {
		state.watchedProfile = watchedProfile;
	},
	SET_SELECTED_PROFILE: (state, selectedProfile) => {
		state.selectedProfile = selectedProfile;
	},
};
const getters = {
	profiles: (state) => state.profiles,
	watchedProfile: (state) => state.watchedProfile,
	selectedProfile: (state) => state.selectedProfile,
};

export default {
	state,
	actions,
	mutations,
	getters,
};
