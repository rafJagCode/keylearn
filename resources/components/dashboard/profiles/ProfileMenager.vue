<template>
  <div class="profile-menager pa-4">
    <profile-list class="mb-8"></profile-list>
    <v-btn @click="deleteProfile()">Delete Profile</v-btn>
    <v-btn @click="useProfile()">Use This Profile</v-btn>
  </div>
</template>
<script>
import ProfileList from '@/components/dashboard/profiles/ProfileList';
import { mapGetters } from 'vuex';
export default {
  computed: {
    ...mapGetters(['user', 'watchedProfile']),
  },
  methods: {
    deleteProfile() {
      Vue.axios.post('/api/delete-profile', this.watchedProfile).then((res) => {
        this.$store.dispatch('setProfiles');
        console.log(res.data);
      });
    },
    useProfile() {
      Vue.axios.post('/api/use-profile', this.watchedProfile).then((res) => {
        this.$store.dispatch('setProfiles');
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
