<template>
  <div>
    <v-app-bar
      app
      :color="color"
      :flat="flat"
      dark
      class="px-15"
      :class="{ expand: flat }"
    >
      <v-toolbar-title v-if="!smallWidth">
        <v-img
          :src="require('@/assets/img/logo.png')"
          max-width="120px"
          min-width="120px"
        />
      </v-toolbar-title>
      <v-spacer />

      <v-btn
        v-for="(item, index) in items"
        :key="index"
        text
        @click="$vuetify.goTo(item.link)"
      >
        <v-icon left>{{ item.icon }}</v-icon>
        <span class="mr-2">{{ item.name }}</span>
      </v-btn>
      <router-link to="/login" style="text-decoration: none; color: inherit" v-if="!isUserAuthenticated">
        <v-btn class="white--text ml-2" color="primaryLight" light>
          <v-icon left>mdi-account-outline</v-icon>
          Login
        </v-btn>
      </router-link>
      <v-btn text height="fit-content" class="ml-2" @click="function(){$router.push({ name: 'dashboard' })}">
        <v-layout justify-center align-center v-if="isUserAuthenticated">
          <v-img width="30px" :src="require('@/assets/img/parrot.svg')"></v-img>
          <span class="ml-2">{{user.email}}</span>
        </v-layout>
      </v-btn>
    </v-app-bar>
  </div>
</template>

<style scoped>
.v-toolbar {
  transition: 0.6s;
}
.expand {
  height: 80px !important;
  padding-top: 10px;
}
</style>

<script>
import {mapGetters} from 'vuex';
export default {
  data: () => ({
    smallWidth: false,
    items: [
      {
        icon: "mdi-home-outline",
        name: "Home",
        link: "#get-started",
      },
      {
        icon: "mdi-rocket-launch-outline",
        name: "Get Started",
        link: "#features",
      },
      {
        icon: "mdi-information-outline",
        name: "About",
        link: "#about",
      },
      {
        icon: "mdi-email-outline",
        name: "Contact",
        link: "#contact",
      },
    ],
  }),
  props: {
    color: String,
    flat: Boolean,
  },
  methods: {
    goToLogin() {
      this.$router.push({ name: "login" });
    },
    onResize() {
      this.smallWidth = window.innerWidth < 960;
    },
  },
  computed:{
    ...mapGetters(['isUserAuthenticated', 'user'])
  },
  mounted() {
    this.onResize();
    window.addEventListener("resize", this.onResize, { passive: true });
  },
};
</script>
