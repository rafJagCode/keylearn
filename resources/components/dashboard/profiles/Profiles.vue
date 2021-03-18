<template>
	<div class="profiles">
		<v-card>
			<v-toolbar flat color="primaryLight" dark>
				<v-toolbar-title>Profiles</v-toolbar-title>
			</v-toolbar>
			<v-tabs vertical color="primaryLight">
				<v-tab>
					<v-icon left> mdi-folder-account-outline </v-icon>
					Profile Menager
				</v-tab>
				<v-tab>
					<v-icon left>mdi-folder-plus-outline</v-icon>
					Create Profile
				</v-tab>

				<v-tab-item>
					<profile-menager></profile-menager>
				</v-tab-item>
				<v-tab-item>
					<create-profile></create-profile>
				</v-tab-item>
			</v-tabs>
		</v-card>
	</div>
</template>
<script>
import ProfileMenager from '@/components/dashboard/profiles/ProfileMenager';
import CreateProfile from '@/components/dashboard/profiles/CreateProfile';
export default {
	components: {
		ProfileMenager,
		CreateProfile,
	},
};
</script>
