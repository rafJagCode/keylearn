<template>
	<div class="profiles pa-4">
		<profile-list></profile-list>
		<v-text-field v-model="profileName" :rules="rules"></v-text-field>
		<v-btn @click="createProfile()">Create Profile</v-btn>
		<v-btn>Update Profile</v-btn>
		<v-btn @click="deleteProfile()">Delete Profile</v-btn>
		<v-btn @click="useProfile()">Use This Profile</v-btn>
	</div>
</template>
<script>
import ProfileList from '@/components/dashboard/settings/ProfileList';
import { mapGetters } from 'vuex';
export default {
	data() {
		return {
			profileName: '',
			rules: [
				(value) => !!value || 'Required.',
				(value) => (value || '').length <= 20 || 'Max 20 characters',
			],
		};
	},
	computed: {
		...mapGetters(['user', 'selectedProfile']),
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
		deleteProfile() {
			Vue.axios
				.post('/api/delete-profile', this.selectedProfile)
				.then((res) => {
					this.$store.dispatch('setProfiles');
					console.log(res.data);
				});
		},
		useProfile() {
			Vue.axios.post('/api/use-profile', this.selectedProfile).then((res) => {
				console.log(res.data);
			});
		},
	},
	components: {
		ProfileList,
	},
};
</script>
<style scoped>
.create-profile {
	width: 40%;
}
.show-profiles {
	width: 40%;
}
</style>
