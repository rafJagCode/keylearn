import axios from 'axios';
const state = {
    profiles: null,
    watchedProfile: null,
};
const actions = {
    async setProfiles({
        commit,
        rootGetters
    }) {
        await axios.post("/api/get-profiles", {
            'id': rootGetters.user.id
        }).then((res) => {
            let profiles = res.data;
            commit('SET_PROFILES', profiles);
            let defaultProfile = profiles.find(obj => obj.id === rootGetters.user.selected_profile_id);
            commit('SET_WATCHED_PROFILE', defaultProfile);
        });
    },
    setWatchedProfile({commit}, watchedProfile){
        commit('SET_WATCHED_PROFILE', watchedProfile);
    }
};
const mutations = {
    SET_PROFILES: (state, profiles) => {
        state.profiles = profiles;
    },
    SET_WATCHED_PROFILE: (state, watchedProfile) => {
        state.watchedProfile = watchedProfile;
    }
};
const getters = {
    profiles: state => state.profiles,
    watchedProfile: state => state.watchedProfile
};

export default {
    state,
    actions,
    mutations,
    getters
}
