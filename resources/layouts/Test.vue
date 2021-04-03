<template>
	<v-app id="test" color="primary">
		<navigation-drawer></navigation-drawer>
		<v-main>
			<v-container style="width: 800px">
				<user-input @typingStarted="typingStarted()"></user-input>
				<stopwatch ref="stopwatch" class="mt-1"></stopwatch>
				<test-activator></test-activator>
				<test-displayer></test-displayer>
				<v-row justify="space-between" align="center" class="my-8">
					<saving-controller></saving-controller>
					<next-test-controller @nextTest="nextTest()"></next-test-controller>
				</v-row>
				<test-results v-if="!isTestRunning"></test-results>
			</v-container>
		</v-main>
	</v-app>
</template>

<script>
import Stopwatch from '@/components/test/Stopwatch';
import TestResults from '@/components/test/TestResults';
import NavigationDrawer from '@/components/utils/NavigationDrawer';
import UserInput from '@/components/test/UserInput';
import TestDisplayer from '@/components/test/TestDisplayer';
import SavingController from '@/components/test/SavingController';
import NextTestController from '@/components/test/NextTestController';
import TestActivator from '@/components/test/TestActivator';
import { mapGetters } from 'vuex';
export default {
	computed: {
		...mapGetters(['isTestRunning', 'isTestActivated', 'text', 'errorWhileLoading']),
	},
	methods: {
		startClock() {
			this.$refs.stopwatch.start();
		},
		typingStarted() {
			this.startClock();
		},
		resetData() {
			this.$store.dispatch('resetTestData');
		},
		resetClock() {
			this.$refs.stopwatch.reset();
		},
		getNewTest() {
			this.$store.dispatch('updateErrorWhileLoadingStatus', false);
			this.$store.dispatch('updateTestLoadingStatus', true);
			Vue.axios
				.post('api/new-test')
				.then((res) => {
					this.$store.dispatch('updateText', res.data);
					this.$store.dispatch('updateTestLoadingStatus', false);
				})
				.catch(() => {
					this.$store.dispatch('updateTestLoadingStatus', false);
					this.$store.dispatch('updateErrorWhileLoadingStatus', true);
				});
		},
		nextTest() {
			this.resetData();
			this.resetClock();
			this.getNewTest();
		},
	},
	components: {
		Stopwatch,
		TestResults,
		NavigationDrawer,
		UserInput,
		TestDisplayer,
		SavingController,
		NextTestController,
		TestActivator,
	},
	mounted() {
		this.resetData();
		this.resetClock();
		this.getNewTest();
	},
};
</script>
<style scoped>
#test {
	background-color: #252c55;
}
</style>
