const INITIAL_STATE = () => {
	return {
		isTestRunning: true,
		isTestActivated: false,
		text: '',
		beforeKeyPress: '',
		typed: '',
		signs: [],
		testLoading: false,
		errorWhileLoading: false,
		errorCounter: 0,
		signsTimeFlags: {},
		errorsPositions: [],
	};
};
const state = INITIAL_STATE();
const actions = {
	testEnded({ commit }) {
		commit('TEST_ENDED');
	},
	testStarted({ commit }) {
		commit('TEST_STARTED');
	},
	activateTest({ commit }) {
		commit('ACTIVATE_TEST');
	},
	deactivateTest({ commit }) {
		commit('DEACTIVATE_TEST');
	},
	resetTestData({ commit }) {
		commit('RESET_TEST_DATA');
	},
	updateBeforeKeyPress({ commit }, value) {
		commit('UPDATE_BEFORE_KEY_PRESS', value);
	},
	updateTyped({ commit }, typed) {
		commit('UPDATE_TYPED', typed);
	},
	updateText({ commit }, text) {
		commit('UPDATE_TEXT', text);
	},
	updateSigns({ commit }, signs) {
		commit('UPDATE_SIGNS', signs);
	},
	updateTestLoadingStatus({ commit }, status) {
		commit('UPDATE_TEST_LOADIN_STATUS', status);
	},
	updateErrorWhileLoadingStatus({ commit }, status) {
		commit('UPDATE_ERROR_WHILE_LOADING_STATUS', status);
	},
	incrementErrorCounter({ commit }) {
		commit('INCREMENT_ERROR_COUNTER');
	},
	setSignsTimeFlags({ commit }, signsTimeFlags) {
		commit('SET_SIGNS_TIME_FLAGS', signsTimeFlags);
	},
	setErrorsPositions({ commit }, errorsPositions) {
		commit('SET_ERRORS_POSITIONS', errorsPositions);
	},
};
const mutations = {
	TEST_ENDED: (state) => (state.isTestRunning = false),
	TEST_STARTED: (state) => (state.isTestRunning = true),
	ACTIVATE_TEST: (state) => (state.isTestActivated = true),
	DEACTIVATE_TEST: (state) => (state.isTestActivated = false),
	RESET_TEST_DATA: (state) => Object.assign(state, INITIAL_STATE()),
	UPDATE_BEFORE_KEY_PRESS: (state, value) => (state.beforeKeyPress = value),
	UPDATE_TYPED: (state, typed) => (state.typed = typed),
	UPDATE_TEXT: (state, text) => (state.text = text),
	UPDATE_SIGNS: (state, signs) => (state.signs = signs),
	UPDATE_TEST_LOADIN_STATUS: (state, status) => (state.testLoading = status),
	UPDATE_ERROR_WHILE_LOADING_STATUS: (state, status) =>
		(state.errorWhileLoading = status),
	INCREMENT_ERROR_COUNTER: (state) => state.errorCounter++,
	SET_SIGNS_TIME_FLAGS: (state, signsTimeFlags) =>
		(state.signsTimeFlags = signsTimeFlags),
	SET_ERRORS_POSITIONS: (state, errorsPositions) =>
		(state.errorsPositions = errorsPositions),
};
const getters = {
	isTestRunning: (state) => state.isTestRunning,
	isTestActivated: (state) => state.isTestActivated,
	beforeKeyPress: (state) => state.beforeKeyPress,
	typed: (state) => state.typed,
	text: (state) => state.text,
	signs: (state) => state.signs,
	testLoading: (state) => state.testLoading,
	errorWhileLoading: (state) => state.errorWhileLoading,
	errorCounter: (state) => state.errorCounter,
	signsTimeFlags: (state) => state.signsTimeFlags,
	errorsPositions: (state) => state.errorsPositions,
};

export default {
	state,
	actions,
	mutations,
	getters,
};
