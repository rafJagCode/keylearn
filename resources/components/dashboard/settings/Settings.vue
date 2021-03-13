<template>
	<div class="settings">
		<v-card>
			<v-toolbar flat color="primaryLight" dark>
				<v-toolbar-title>Settings</v-toolbar-title>
			</v-toolbar>
			<v-tabs vertical color="primaryLight">
				<v-tab>
					<v-icon left> mdi-folder-account-outline </v-icon>
					Profiles
				</v-tab>

				<v-tab-item>
					<profiles></profiles>
				</v-tab-item>
			</v-tabs>
		</v-card>
	</div>
</template>
<script>
import Profiles from '@/components/dashboard/settings/Profiles';
export default {
	components: {
		Profiles,
	},
};
</script>
