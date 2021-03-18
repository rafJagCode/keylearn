<template>
	<div class="profile-list" v-if="profiles !== null && watchedProfile !== null">
		<v-list light elevation="4">
			<v-list-group v-model="opened" prepend-icon="mdi-folder-account-outline">
				<template v-slot:activator>
					<v-list-item-title>{{ watchedProfile.name }}</v-list-item-title>
				</template>
				<v-list-item @click="watchProfile(profile)" link v-for="profile in profiles" :key="profile.id">
					{{ profile.name }}
					<v-spacer></v-spacer>
					<span v-if="selectedProfile.id === profile.id" class="green--text text-caption">
						<v-icon small class="green--text">mdi-check</v-icon>Active
					</span>
				</v-list-item>
			</v-list-group>
		</v-list>
	</div>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
	data() {
		return {
			opened: false,
		};
	},
	computed: {
		...mapGetters(['profiles', 'selectedProfile']),
		watchedProfile: {
			get() {
				return this.$store.getters.watchedProfile;
			},
			set(watchedProfile) {
				this.$store.dispatch('setWatchedProfile', watchedProfile);
				this.$store.dispatch('setResults');
			},
		},
	},
	methods: {
		watchProfile(profile) {
			this.watchedProfile = profile;
			this.opened = false;
		},
	},
};
</script>
