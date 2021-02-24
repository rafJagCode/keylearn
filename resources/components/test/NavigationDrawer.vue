<template>
  <v-navigation-drawer
    app
    class="pa-0"
    color="secondary"
    expand-on-hover
    permanent
  >
    <v-list-item class="px-2">
      <v-list-item-avatar>
        <v-img :src="require('@/assets/img/parrot.svg')"></v-img>
      </v-list-item-avatar>
      <v-list-item-content>
        <v-list-item-title class="primaryLight--text font-weight-bold">
          {{userName}}
        </v-list-item-title>
      </v-list-item-content>
    </v-list-item>
    <v-list rounded dense class="text-h4">
      <v-hover v-slot="{ hover }" v-for="(item, index) in items" :key="index">
        <v-list-item
          class="px-2"
          :class="{ 'list--hover': hover }"
          link
          @click.prevent="goTo(item.link)"
        >
          <v-list-item-icon>
            <v-icon medium color="primaryLight">{{ item.icon }}</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title class="primaryLight--text font-weight-bold">
              {{ item.text }}
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-hover>
    </v-list>
  </v-navigation-drawer>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
  data() {
    return {
      items: [
        {
          link: "login",
          icon: "mdi-account-outline",
          text: "Login",
        },
        {
          link: "home",
          icon: "mdi-home-outline",
          text: "Home",
        },
      ],
    };
  },
  computed:{
    ...mapGetters(['isUserAuthenticated', 'user']),
    userName(){
      if(!this.isUserAuthenticated) return "Not logged in";
      return this.user.email;
    }
  },
  methods: {
    goTo(link) {
      this.$router.push({ name: link });
    },
  },
};
</script>