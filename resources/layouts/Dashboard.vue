<template>
  <div class="dashboard">
    Dashboard <br />
    Email: {{ email }}<br /><br />
    <v-btn @click.prevent="logout()">Logout</v-btn>
  </div>
</template>
<script>
import {mapGetters} from 'vuex';
export default {
  computed:{
    ...mapGetters(['user']),
    email(){
      if(this.user===null) return '';
      return this.user.email;
    }
  },
  methods: {
    logout() {
      this.$store.dispatch('signOut').then(() => {
        this.$router.push({ name: "home" });
      });
    },
  },
};
</script>