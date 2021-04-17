<template>
  <v-card class="test-results pa-2" width="250px" height="250px">
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
        <v-row class="text-subtitle-2 font-weight-black">
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
    bestAvgTime: null,
  },
  computed: {
    avgSpeed() {
      let avg_time = this.charStatistics.avg_time;
      return Math.round(60 / avg_time / 5);
    },
    percentCorrect() {
      let samples = this.charStatistics.samples;
      let correct = this.charStatistics.correct;
      return Math.round((correct / samples) * 100);
    },
    percentSpeed() {
      let avg_time = this.charStatistics.avg_time;
      return Math.round((this.bestAvgTime / avg_time) * 100);
    },
  },
};
</script>
