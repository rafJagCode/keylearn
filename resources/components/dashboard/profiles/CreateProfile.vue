<template>
	<v-container class="create-profile">
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
					user_id: this.user.id,
					name: this.profileName,
				})
				.then((res) => {
					this.$store.dispatch('setProfiles');
					console.log(res.data);
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
