<template>
  <div class="profiles pa-4">
    <v-container class="show-profiles">
      <v-row justify="center" align="center">
        <v-combobox
          item-text="name"
          :items="profiles"
          v-model="selected"
        ></v-combobox>
      </v-row>
    </v-container>
    <v-container class="create-profile">
      <v-row justify="center" align="center">
        <v-text-field v-model="profileName" :rules="rules"></v-text-field>
        <v-btn @click="createProfile()" small class="ml-4"
          >Create Profile</v-btn
        >
      </v-row>
    </v-container>
    <v-btn>Update Profile</v-btn>
    <v-btn @click="removeProfile()">Remove Profile</v-btn>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      selected: null,
      profileName: "",
      rules: [
        (value) => !!value || "Required.",
        (value) => (value || "").length <= 20 || "Max 20 characters",
      ],
    };
  },
  computed: {
    ...mapGetters(["user", "profiles", "watchedProfile"]),
  },
  watch:{
    selected: function(selected){
      if(selected === null && this.watchedProfile !== null) {
        this.selected = this.watchedProfile;
      }
    }
  },
  methods: {
    createProfile() {
      Vue.axios
        .post("/api/create-profile", {
          user_id: this.user.id,
          name: this.profileName,
        })
        .then((res) => {
          this.$store.dispatch("setProfiles");
          console.log(res.data);
        });
    },
    removeProfile() {},
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