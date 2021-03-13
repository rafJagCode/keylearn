<template>
	<v-container class="tests-history">
		<v-container>
			<v-row justify="space-around">
				<v-checkbox
					v-for="checkbox in checkboxes"
					:key="checkbox.label"
					v-model="selected"
					:label="checkbox.label"
					:value="checkbox.value"
				></v-checkbox>
			</v-row>
		</v-container>
		<v-row>
			<v-col cols="4" v-for="test in tests" :key="test.id">
				<v-row justify="center">
					<result
						:test="test"
						:selectedOptions="selected"
						@removeTestResults="removeTestResults"
					></result>
				</v-row>
			</v-col>
		</v-row>
	</v-container>
</template>
<script>
import { mapGetters } from 'vuex';
import Result from '@/components/dashboard/statistics/Result';
export default {
	data() {
		return {
			checkboxes: [
				{
					label: 'Time',
					value: 'time',
				},
				{
					label: 'Score',
					value: 'score',
				},
				{
					label: 'WPM',
					value: 'wpm',
				},
				{
					label: 'All Errors',
					value: 'allErrors',
				},
				{
					label: 'Uncorrected Errors',
					value: 'uncorrectedErrors',
				},
				{
					label: 'Accuracy',
					value: 'accuracy',
				},
				{
					label: 'Test Length',
					value: 'testLength',
				},
			],
			selected: [
				'time',
				'wpm',
				'score',
				'allErrors',
				'uncorrectedErrors',
				'accuracy',
				'testLength',
			],
		};
	},
	computed: {
		...mapGetters(['user', 'watchedProfile', 'tests']),
	},
	watch: {
		watchedProfile: function (watchedProfile) {
			if (watchedProfile !== null) this.setResults();
		},
	},
	methods: {
		setResults() {
			this.$store.dispatch('setResults', this.watchedProfile.id).then(() => {});
		},
		removeTestResults(testId) {
			Vue.axios.post('/api/delete-test-results', { id: testId }).then(() => {
				this.setResults();
			});
		},
	},
	components: {
		Result,
	},
};
</script>
