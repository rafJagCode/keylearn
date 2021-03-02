<template>
  <div class="dashboard">
    <navigation-drawer></navigation-drawer>
    <router-view class="ma-2 ml-16"></router-view>
  </div>
</template>
<script>
import {mapGetters} from 'vuex';
import NavigationDrawer from '@/components/utils/NavigationDrawer'
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
  components: {
    NavigationDrawer
  }
};
</script>
