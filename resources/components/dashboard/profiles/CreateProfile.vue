<template>
	<v-container class="create-profile">
		<v-text-field v-model="profileName" :rules="rules"></v-text-field>
		<v-btn @click="createProfile()">Create Profile</v-btn>
		<v-btn @click="handleClick()">Test</v-btn>
	</v-container>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
	data() {
		return {
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
		async handleClick() {
			let auth = await Vue.axios.get('/api/authenticated');
			console.log(auth.data);
		},
	},
};
</script>
