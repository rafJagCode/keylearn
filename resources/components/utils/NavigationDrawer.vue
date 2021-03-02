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
          {{ userName }}
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
      <v-hover v-slot="{ hover }">
        <v-list-item
          class="px-2"
          :class="{ 'list--hover': hover }"
          link
          @click.prevent="signOut()"
        >
          <v-list-item-icon>
            <v-icon medium color="primaryLight">mdi-logout-variant</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title class="primaryLight--text font-weight-bold">
              Logout
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-hover>
    </v-list>
  </v-navigation-drawer>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      items: [],
    };
  },
  mounted() {
    this.setItems();
  },
  computed: {
    ...mapGetters(["isUserAuthenticated", "user"]),
    userName() {
      if (!this.isUserAuthenticated) return "Not logged in";
      return this.user.email;
    },
  },
  methods: {
    goTo(link) {
      this.$router.push({ name: link });
    },
    signOut() {
      this.$store.dispatch("signOut");
    },
    setItems() {
      if (this.$route.name !== "test") {
        this.items.push({
          link: "test",
          icon: "mdi-keyboard-outline",
          text: "Practice Typing",
        });
      }
      if (this.isUserAuthenticated) {
        this.items.push(
          {
            link: "home",
            icon: "mdi-home-outline",
            text: "Home",
          },
          {
            link: "statistics",
            icon: "mdi-chart-line",
            text: "Statistics",
          },
          {
            link: "settings",
            icon: "mdi-cog-outline",
            text: "Settings",
          },
        );
      } else {
        this.items = [
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
        ];
      }
    },
  },
};
</script>
<style scoped>
.list--hover {
  background-color: #252c55;
}
</style>