<template>
  <div>
    <v-navigation-drawer
      v-model="drawer"
      app
      temporary
      dark
      :src="require('@/assets/img/bgDrawer.jpg')"
    >
      <v-list>
        <v-list-item>
          <v-list-item-avatar>
            <img class="drawer-logo" src="@/assets/img/logo.png" alt="Logo" />
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title class="title">Keylearn</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
      <v-divider />

      <v-list dense>
        <v-list-item @click.prevent="goToLogin()">
          <v-list-item-icon class="justify-center">
            <v-icon>mdi-account-outline</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title class="subtitile-1"> Login </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item
          v-for="(item, index) in items"
          :key="index"
          @click="$vuetify.goTo(item.link)"
        >
          <v-list-item-icon class="justify-center">
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title class="subtitile-1">{{
              item.name
            }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      app
      :color="color"
      :flat="flat"
      dark
      class="px-15"
      :class="{ expand: flat }"
    >
      <v-toolbar-title>
        <v-img :src="require('@/assets/img/logo.png')" max-width="120px" />
      </v-toolbar-title>
      <v-spacer />
      <v-app-bar-nav-icon
        @click.stop="drawer = !drawer"
        class="mr-4"
        v-if="isXs"
      />
      <div v-else>
        <v-btn
          v-for="(item, index) in items"
          :key="index"
          text
          @click="$vuetify.goTo(item.link)"
        >
          <v-icon left>{{ item.icon }}</v-icon>
          <span class="mr-2">{{ item.name }}</span>
        </v-btn>
        <router-link to="/login" style="text-decoration: none; color: inherit">
          <v-btn>
            <v-icon left>mdi-account-outline</v-icon>
            Login
          </v-btn>
        </router-link>
        <!-- <v-btn text @click="$vuetify.goTo('#features')">
          <span class="mr-2">Get Started</span>
        </v-btn>
        <v-btn text @click="$vuetify.goTo('#about')">
          <span class="mr-2">About</span>
        </v-btn>
        <v-btn text @click="$vuetify.goTo('#contact')">
          <span class="mr-2">Contact Us</span>
        </v-btn>
        <v-btn text>
          <span class="mr-2">Login</span>
        </v-btn>
        <v-btn rounded outlined text>
          <span class="mr-2">Sign Up</span>
        </v-btn> -->
      </div>
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
.drawer-logo {
  height: 20px;
  width: 40px;
  background-size: cover;
}
</style>

<script>
export default {
  data: () => ({
    drawer: null,
    isXs: false,
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
    onResize() {
      this.isXs = window.innerWidth < 960;
    },
    goToLogin() {
      this.$router.push({ name: "login" });
    },
  },

  watch: {
    isXs(value) {
      if (!value) {
        if (this.drawer) {
          this.drawer = false;
        }
      }
    },
  },
  mounted() {
    this.onResize();
    window.addEventListener("resize", this.onResize, { passive: true });
  },
};
</script>
