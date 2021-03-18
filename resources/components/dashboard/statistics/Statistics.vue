<template>
	<div class="statistics">
		<v-card>
			<v-toolbar class="tool" flat color="primaryLight" dark>
				<v-toolbar-title> Statistics </v-toolbar-title>
				<v-spacer></v-spacer>
				<div class="profile-selection">
					<profile-list class="ma-2"></profile-list>
				</div>
			</v-toolbar>
			<v-tabs vertical color="primaryLight">
				<v-tab>
					<v-icon left> mdi-history </v-icon>
					Tests history
				</v-tab>
				<v-tab>
					<v-icon left> mdi-chart-line </v-icon>
					Tests Analysis
				</v-tab>
				<v-tab>
					<v-icon left> mdi-clock-fast </v-icon>
					Words Speed
				</v-tab>

				<v-tab-item>
					<tests-history></tests-history>
				</v-tab-item>
				<v-tab-item>
					<tests-analysis></tests-analysis>
				</v-tab-item>
				<v-tab-item>
					<words-typing-speed></words-typing-speed>
				</v-tab-item>
			</v-tabs>
		</v-card>
	</div>
</template>
<script>
import TestsHistory from '@/components/dashboard/statistics/TestsHistory';
import TestsAnalysis from '@/components/dashboard/statistics/TestsAnalysis';
import WordsTypingSpeed from '@/components/dashboard/statistics/WordsTypingSpeed';
import ProfileList from '@/components/dashboard/profiles/ProfileList';
import { mapGetters } from 'vuex';
export default {
	components: {
		TestsHistory,
		TestsAnalysis,
		WordsTypingSpeed,
		ProfileList,
	},
	computed: {
		...mapGetters(['profiles']),
		watchedProfile: {
			get() {
				return this.$store.getters.watchedProfile;
			},
			set(watchedProfile) {
				this.$store.dispatch('setWatchedProfile', watchedProfile);
			},
		},
	},
};
</script>
<style scoped>
.tool {
	position: relative;
	z-index: 2;
}
.profile-selection {
	position: absolute;
	top: 0px;
	right: 0;
	width: 400px;
}
</style>
