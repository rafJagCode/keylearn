<template>
	<v-container class="create-profile">
		<v-alert type="error" v-if="error">{{ error }}</v-alert>
		<v-text-field v-model="profileName" :rules="rules"></v-text-field>
		<v-textarea
			label="Words that you would like to practice"
			hint="Words can be separated by any whitespace(space, tab, enter...)"
			outlined
			no-resize
			filled
			clearable
			v-model="wordsField"
		></v-textarea>
		<v-chip outlined label close @click:close="removeWord(index)" v-for="(word, index) in wordsToAdd" :key="word">{{
			word
		}}</v-chip>
		<v-btn @click="addWords()">Add words</v-btn>
		<v-btn @click="createProfile()">Create Profile</v-btn>
	</v-container>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
	data() {
		return {
			error: null,
			wordsField: '',
			wordsToAdd: [],
			profileName: '',
			rules: [(value) => !!value || 'Required.', (value) => (value || '').length <= 20 || 'Max 20 characters'],
		};
	},
	computed: {
		...mapGetters(['user']),
	},
	methods: {
		createProfile() {
			Vue.axios
				.post('/api/create-profile', {
					name: this.profileName,
					words: this.wordsToAdd,
				})
				.then(() => {
					this.$store.dispatch('setProfiles');
				})
				.catch((error) => {
					this.error = error.response.data.message;
				});
		},
		addWords() {
			let words = this.wordsField.trim().split(/\s+/);
			words.forEach((word) => {
				if (!this.wordsToAdd.includes(word)) {
					this.wordsToAdd.push(word);
				}
			});
		},
		removeWord(index) {
			this.wordsToAdd.splice(index, 1);
		},
	},
};
</script>
