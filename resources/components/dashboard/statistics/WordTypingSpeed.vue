<template>
	<div class="word">
		<v-sheet elevation="4" outlined class="my-2 py-1 px-2">
			<v-row align="center" justify="center">
				<v-col cols="2" class="text-center">
					<span>{{ word.name }}</span>
				</v-col>
				<v-col cols="10">
					<v-progress-linear height="20" color="green" background-color="red" :value="result" striped>
						{{ time }}
					</v-progress-linear></v-col
				>
			</v-row>
		</v-sheet>
	</div>
</template>
<script>
export default {
	props: {
		word: null,
		bestResult: null,
	},
	computed: {
		time() {
			return Math.round(60 / this.word.time / 5) + ' WPM';
		},
		result() {
			let result = (this.bestResult / this.word.time) * 100;
			return result;
		},
	},
};
</script>
