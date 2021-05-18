<template>
  <div class="profiles">
    <v-card background-color="transparent">
      <v-toolbar flat color="primaryLight" dark>
        <v-toolbar-title>Profiles</v-toolbar-title>
      </v-toolbar>
      <v-tabs class="profiles__window" vertical color="primaryLight" background-color="transparent">
        <v-tab>
          <v-icon left> mdi-folder-account-outline </v-icon>
          Profile Manager
        </v-tab>
        <v-tab>
          <v-icon left>mdi-folder-plus-outline</v-icon>
          Create Profile
        </v-tab>
        <v-tab>
          <v-icon left>mdi-folder-move-outline</v-icon>
          Update Profile
        </v-tab>

        <v-tab-item>
          <profile-menager></profile-menager>
        </v-tab-item>
        <v-tab-item>
          <create-profile></create-profile>
        </v-tab-item>
        <v-tab-item>
          <update-profile></update-profile>
        </v-tab-item>
      </v-tabs>
    </v-card>
  </div>
</template>
<script>
import ProfileMenager from '@/components/dashboard/profiles/ProfileMenager';
import CreateProfile from '@/components/dashboard/profiles/CreateProfile';
import UpdateProfile from '@/components/dashboard/profiles/UpdateProfile';
export default {
  components: {
    ProfileMenager,
    CreateProfile,
    UpdateProfile,
  },
};
</script>
<style scoped>
.profiles__window {
  background: #a8e2f9;
  background: -webkit-linear-gradient(top left, #a8e2f9 0%, #d3f0fb 100%);
  background: -moz-linear-gradient(top left, #a8e2f9 0%, #d3f0fb 100%);
  background: -o-linear-gradient(top left, #a8e2f9 0%, #d3f0fb 100%);
  background: linear-gradient(to bottom right, #a8e2f9 0%, #d3f0fb 100%);
  min-height: calc(100vh - 80px);
}
</style>
