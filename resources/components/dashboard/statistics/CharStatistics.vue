<template>
  <v-card class="test-results pa-2" width="250px" height="250px">
    <v-badge class="sample-badge" color="primaryLight">
      <span slot="badge">Samples: {{ charStatistics.samples }}</span>
    </v-badge>
    <v-layout column align-center fill-height justify-space-around>
      <v-row>
        <v-card-title class="font-weight-black purple--text display-2">
          <span class="pa-2">{{ charStatistics.char }}</span>
        </v-card-title>
      </v-row>
      <v-card-text>
        <v-row>
          <v-col cols="auto">
            <v-progress-circular :size="80" :width="8" :value="percentCorrect" color="teal" class="text-caption">
              {{ percentCorrect }}%
            </v-progress-circular>
          </v-col>
          <v-col cols="auto">
            <v-progress-circular :size="80" :width="8" :value="percentSpeed" color="purple" class="text-caption">
              {{ avgSpeed }}WPM
            </v-progress-circular>
          </v-col>
        </v-row>
        <v-row class="text-subtitle-2 font-weight-black mb-2">
          <v-col cols="auto">Accuracy</v-col>
          <v-col cols="auto">Average speed</v-col>
        </v-row>
      </v-card-text>
    </v-layout>
  </v-card>
</template>
<script>
export default {
  props: {
    charStatistics: null,
    bestAvgWpm: null,
  },
  computed: {
    avgSpeed() {
      return Math.round(this.charStatistics.avg_wpm);
    },
    percentCorrect() {
      return Math.round(this.charStatistics.accuracy);
    },
    percentSpeed() {
      let avg_wpm = this.charStatistics.avg_wpm;
      return Math.round((this.bestAvgWpm / avg_wpm) * 100);
    },
  },
};
</script>
<style scoped>
.samples-badge {
  position: absolute;
  left: 20px;
  top: 10px;
}
.test-results {
  background-color: transparent;
}
.test-results::before {
  content: '';
  width: 100%;
  height: 100%;
  position: absolute;
  background-color: rgba(255, 255, 255, 0.7);
  filter: blur(40px);
}
</style>
