<template>
  <v-card class="test-results pa-2" width="250px" height="250px">
    <v-layout column align-center fill-height justify-space-around>
      <v-row>
        <v-card-title class="text-heading-6 font-weight-black"> KEY: {{ charStatistics.char }} </v-card-title>
      </v-row>
      <v-card-text>
        <v-row>
          <v-col cols="auto">
            <v-progress-circular :size="80" :width="8" :value="percentCorrect" color="teal" class="text-caption">
              {{ percentCorrect }}%
            </v-progress-circular>
          </v-col>
          <v-col cols="auto">
            <v-progress-circular :size="80" :width="8" :value="percentSpeed" color="teal" class="text-caption">
              {{ charStatistics.avgWpm }}WPM
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
    bestSpeed: null,
  },
  computed: {
    percentCorrect() {
      let all = this.charStatistics.all;
      let incorrect = this.charStatistics.incorrect;
      return Math.round(((all - incorrect) / all) * 100);
    },
    percentSpeed() {
      let avgWpm = this.charStatistics.avgWpm;
      return Math.round((avgWpm / this.bestSpeed) * 100);
    },
  },
};
</script>
