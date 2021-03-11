<template>
  <div class="statistics">
    <v-card>
      <v-toolbar flat color="primaryLight" dark>
        <v-toolbar-title> Statistics </v-toolbar-title>
        <v-spacer></v-spacer>
        <div class="profile-selection">
          <v-combobox
            v-model="watchedProfile"
            :items="profiles"
            item-text="name"
            hint="Select profile"
            persistent-hint
          ></v-combobox>
        </div>
      </v-toolbar>
      <v-tabs vertical color="primaryLight">
        <v-tab>
          <v-icon left> mdi-history </v-icon>
          Tests history
        </v-tab>
        <v-tab>
          <v-icon left> mdi-chart-line </v-icon>
          Tests Analysis
        </v-tab>
        <v-tab>
          <v-icon left> mdi-access-point </v-icon>
          Option 3
        </v-tab>

        <v-tab-item>
          <tests-history></tests-history>
        </v-tab-item>
        <v-tab-item>
          <tests-analysis></tests-analysis>
        </v-tab-item>
        <v-tab-item>
          <span>Lubie placki 2</span>
        </v-tab-item>
      </v-tabs>
    </v-card>
  </div>
</template>
<script>
import TestsHistory from "@/components/dashboard/statistics/TestsHistory";
import TestsAnalysis from "@/components/dashboard/statistics/TestsAnalysis";
import { mapGetters } from "vuex";
export default {
  components: {
    TestsHistory,
    TestsAnalysis,
  },
  computed: {
    ...mapGetters(["profiles"]),
    watchedProfile:{
      get(){
        return this.$store.getters.watchedProfile;
      },
      set(watchedProfile){
        this.$store.dispatch('setWatchedProfile', watchedProfile);
      }
    }
  },
};
</script>
<style scoped>
.profile-selection {
  width: 400px;
}
</style>