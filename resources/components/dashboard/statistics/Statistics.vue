<template>
  <div class="statistics">
    <v-card background-color="transparent">
      <v-toolbar class="tool" flat color="primaryLight" dark>
        <v-toolbar-title> Statistics </v-toolbar-title>
        <v-spacer></v-spacer>
        <div class="profile-selection">
          <profile-list class="ma-2"></profile-list>
        </div>
      </v-toolbar>
      <v-tabs class="statistics__window" vertical color="primaryLight" background-color="transparent">
        <v-tab>
          <v-icon left> mdi-history </v-icon>
          Tests history
        </v-tab>
        <v-tab>
          <v-icon left> mdi-chart-line </v-icon>
          Tests Analysis
        </v-tab>
        <v-tab>
          <v-icon left> mdi-clock-fast </v-icon>
          Words Speed
        </v-tab>
        <v-tab>
          <v-icon left> mdi-chart-bar </v-icon>
          Chars Statistics
        </v-tab>

        <v-tab-item>
          <tests-history></tests-history>
        </v-tab-item>
        <v-tab-item>
          <tests-analysis></tests-analysis>
        </v-tab-item>
        <v-tab-item>
          <words-typing-speed></words-typing-speed>
        </v-tab-item>
        <v-tab-item>
          <chars-statistics></chars-statistics>
        </v-tab-item>
      </v-tabs>
    </v-card>
  </div>
</template>
<script>
import TestsHistory from '@/components/dashboard/statistics/TestsHistory';
import TestsAnalysis from '@/components/dashboard/statistics/TestsAnalysis';
import WordsTypingSpeed from '@/components/dashboard/statistics/WordsTypingSpeed';
import CharsStatistics from '@/components/dashboard/statistics/CharsStatistics';
import ProfileList from '@/components/dashboard/profiles/ProfileList';
import { mapGetters } from 'vuex';
export default {
  components: {
    TestsHistory,
    TestsAnalysis,
    WordsTypingSpeed,
    CharsStatistics,
    ProfileList,
  },
  computed: {
    ...mapGetters(['profiles']),
    watchedProfile: {
      get() {
        return this.$store.getters.watchedProfile;
      },
      set(watchedProfile) {
        this.$store.dispatch('setWatchedProfile', watchedProfile);
      },
    },
  },
};
</script>
<style scoped>
.tool {
  position: relative;
  z-index: 2;
}
.profile-selection {
  position: absolute;
  top: 0px;
  right: 0;
  width: 400px;
}
.statistics__window {
  background: #a8e2f9;
  background: -webkit-linear-gradient(top left, #a8e2f9 0%, #d3f0fb 100%);
  background: -moz-linear-gradient(top left, #a8e2f9 0%, #d3f0fb 100%);
  background: -o-linear-gradient(top left, #a8e2f9 0%, #d3f0fb 100%);
  background: linear-gradient(to bottom right, #a8e2f9 0%, #d3f0fb 100%);
  min-height: calc(100vh - 80px);
}
</style>
