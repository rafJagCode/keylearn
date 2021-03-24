<template>
	<v-container class="chars-statistics">
		<div v-for="charStatistics in charsStatistics" :key="charStatistics.id">
			{{ charStatistics.char }}
		</div>
	</v-container>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
	computed: {
		...mapGetters(['tests']),
		charsStatistics() {
			return [...this.tests]
				.map((test) => {
					return test.chars_statistics;
				})
				.flat(Infinity);
		},
	},
};
</script>
