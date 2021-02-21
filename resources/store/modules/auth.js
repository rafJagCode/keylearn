import axios from 'axios';
const state = {
    isUserAuthenticated: false,
    user: null
};
const actions = {
    async signIn({dispatch}, credentials) {
        await axios.get('sanctum/csrf-cookie')
        await axios.post('/api/login', credentials)
        return dispatch('setUserStoreState')
    },

    async signOut({dispatch}) {
        await axios.post('/api/logout')
        return dispatch('setUserStoreState')
    },

    setUserStoreState({commit}) {
        return axios.get('/api/user').then((response) => {
            commit('SET_AUTHENTICATED', true)
            commit('SET_USER', response.data)
        }).catch(() => {
            commit('SET_AUTHENTICATED', false)
            commit('SET_USER', null)
        })
    }
};
const mutations = {
    SET_AUTHENTICATED: (state, value) => {
        state.isUserAuthenticated = value;
    },
    SET_USER: (state, user) => {
        state.user = user;
    }

};
const getters = {
    isUserAuthenticated: state => state.isUserAuthenticated,
    user: state => state.user
};

export default {
    state,
    actions,
    mutations,
    getters
}
