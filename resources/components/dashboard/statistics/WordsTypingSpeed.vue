<template>
	<v-container class="words-typing-speed">
		<v-btn @click="showWordsTypingSpeed">Words Typing Speed</v-btn>
	</v-container>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
	computed: {
		...mapGetters(['tests']),
	},
	methods: {
		getWordsTypingTimes() {
			return [...this.tests]
				.map((test) => {
					return test.words_typing_times;
				})
				.flat(Infinity);
		},
		getSegregatedWordsTypingTimes() {
			let times = this.getWordsTypingTimes();
			let segregated = Object.create(null);
			times.forEach((word) => {
				if (segregated[word.word]) {
					segregated[word.word] = [segregated[word.word], word.time].flat(Infinity);
				} else {
					segregated[word.word] = word.time;
				}
			});
			return segregated;
		},
		showWordsTypingSpeed() {
			//console.log(this.getWordsTypingTimes());
			console.log(this.getSegregatedWordsTypingTimes());
		},
	},
};
</script>
