<template>
  <div class="profile-menager pa-4">
    <v-snackbar v-model="profileChanged" :timeout="1000" centered>
      <v-row align="center" justify="space-around">
        <span class="ml-3">Profile is ready to use</span>
        <v-spacer></v-spacer>
        <v-btn text color="primaryLight" @click.native="created = false">Close</v-btn>
      </v-row>
    </v-snackbar>
    <profile-list class="mb-8"></profile-list>
    <v-btn :disabled="watchedProfile.name === 'Starting Profile'" @click="deleteProfile()">Delete Profile</v-btn>
    <v-btn @click="useProfile()">Use This Profile</v-btn>
  </div>
</template>
<script>
import ProfileList from '@/components/dashboard/profiles/ProfileList';
import { mapGetters } from 'vuex';
export default {
  data() {
    return {
      profileChanged: false,
    };
  },
  computed: {
    ...mapGetters(['user', 'watchedProfile']),
  },
  methods: {
    deleteProfile() {
      Vue.$confirm({
        title: 'Delete Profile',
        message: 'Do you realy want to delete this profile?',
        button: {
          yes: 'YES',
          no: 'NO',
        },
        /**
         * Callback Function
         * @param {Boolean} confirm
         */
        callback: (confirm) => {
          if (confirm) {
            Vue.axios.post('/api/delete-profile', this.watchedProfile).then(async (res) => {
              await this.$store.dispatch('setProfiles');
              this.$store.dispatch('setResults');
              this.$store.dispatch('setGeneralStatistics');
            });
          }
        },
      });
    },
    useProfile() {
      Vue.axios.post('/api/use-profile', this.watchedProfile).then((res) => {
        this.$store.dispatch('setProfiles');
        this.profileChanged = true;
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
