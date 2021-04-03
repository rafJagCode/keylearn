<template>
	<div class="dashboard">
		<navigation-drawer></navigation-drawer>
		<v-container style="height: 100vh" v-if="profilLoader || dataLoader || error">
			<v-layout align-center justify-center fill-height>
				<v-row justify="center" align="center" class="text-subtitle-1 font-weight-black">
					<v-progress-circular
						v-if="(profilLoader || dataLoader) && !error"
						indeterminate
						color="primaryLight"
						class="mr-2"
					></v-progress-circular>
					<span v-if="profilLoader && !error">Loading Profiles...</span>
					<span v-if="dataLoader && !error">Loading Data...</span>
					<div v-if="error">
						<span>There was a problem with loading your data</span>
						<v-btn class="ml-2" outlined text @click="loadData()">Try Again</v-btn>
					</div>
				</v-row>
			</v-layout>
		</v-container>
		<router-view v-if="!profilLoader && !dataLoader && !error" class="ma-2 ml-16"></router-view>
	</div>
</template>
<script>
import { mapGetters } from 'vuex';
import NavigationDrawer from '@/components/utils/NavigationDrawer';
export default {
	data() {
		return {
			profilLoader: false,
			dataLoader: false,
			error: false,
		};
	},
	computed: {
		...mapGetters(['user', 'watchedProfile']),
		email() {
			if (this.user === null) return '';
			return this.user.email;
		},
	},
	methods: {
		logout() {
			this.$store.dispatch('signOut').then(() => {
				this.$router.push({ name: 'home' });
			});
		},
		async setProfiles() {
			return this.$store.dispatch('setProfiles');
		},
		async setResults() {
			return this.$store.dispatch('setResults');
		},
		async loadData() {
			try {
				this.error = false;
				this.profilLoader = true;
				await this.setProfiles();
				this.profilLoader = false;
				this.dataLoader = true;
				await this.setResults();
				this.dataLoader = false;
			} catch {
				this.error = true;
			}
		},
	},
	async mounted() {
		this.loadData();
	},
	components: {
		NavigationDrawer,
	},
};
</script>
