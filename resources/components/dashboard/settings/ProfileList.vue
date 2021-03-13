<template>
	<div
		class="profile-list"
		v-if="profiles !== null && selectedProfile !== null"
	>
		<v-list>
			<v-list-group :value="false" prepend-icon="mdi-folder-account-outline">
				<template v-slot:activator>
					<v-list-item-title>{{ selectedProfile.name }}</v-list-item-title>
				</template>
				<v-list-item
					@click="selectProfile(profile)"
					link
					v-for="profile in profiles"
					:key="profile.id"
				>
					{{ profile.name }}
				</v-list-item>
			</v-list-group>
		</v-list>
	</div>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
	computed: {
		...mapGetters(['profiles']),
		selectedProfile: {
			get() {
				return this.$store.getters.selectedProfile;
			},
			set(selectedProfile) {
				this.$store.dispatch('setSelectedProfile', selectedProfile);
			},
		},
	},
	methods: {
		selectProfile(profile) {
			this.selectedProfile = profile;
		},
	},
};
</script>
