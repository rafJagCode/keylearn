<template>
  <v-card class="test-results pa-2" width="250px" height="250px">
    <v-layout column align-center fill-height justify-space-around>
      <v-row>
        <v-card-title class="font-weight-black purple--text display-3">
          <span class="pa-2">{{ word.name }}</span>
        </v-card-title>
      </v-row>
      <v-card-text>
        <v-row>
          <v-col cols="auto">
            <v-progress-circular :size="80" :width="8" :value="percentSpeed" color="teal" class="text-caption">
              {{ avgSpeed }}%
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
    word: null,
    bestResult: null,
  },
  computed: {
    avgSpeed() {
      return Math.round(60 / this.word.time / 5);
    },
    percentSpeed() {
      let percentSpeed = (this.bestResult / this.word.time) * 100;
      return percentSpeed;
    },
  },
};
</script>
