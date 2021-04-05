<template>
  <v-container class="chars-statistics">
    <v-row>
      <v-col class="my-2" cols="3" v-for="charStatistics in charsSegregated" :key="charStatistics.char">
        <v-row justify="center">
          <char-statistics :charStatistics="charStatistics" :bestSpeed="bestSpeed"></char-statistics>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
import { mapGetters } from 'vuex';
import CharStatistics from '@/components/dashboard/statistics/CharStatistics.vue';
export default {
  computed: {
    ...mapGetters(['tests']),
    charsStatistics() {
      return [...this.tests]
        .map((test) => {
          return test.chars_statistics;
        })
        .flat(Infinity);
    },
    charsSegregated() {
      let chars = this.charsStatistics;
      let charsSegregated = new Object();
      chars.forEach((char) => {
        if (char.char in charsSegregated) {
          if (!char.correct) {
            charsSegregated[char.char].incorrect++;
          }
          if (char.correct) {
            charsSegregated[char.char].totalTime += char.time;
          }
          charsSegregated[char.char].all++;
        } else {
          let newChar = {
            [char.char]: {
              incorrect: char.correct ? 0 : 1,
              all: 1,
              totalTime: char.correct ? char.time : 0,
            },
          };
          charsSegregated = { ...charsSegregated, ...newChar };
        }
      });
      let processed = Object.entries(charsSegregated).map(([key, value]) => {
        return {
          char: key,
          all: value.all,
          incorrect: value.incorrect,
          avgWpm: Math.round(60 / (value.totalTime / (value.all - value.incorrect)) / 5),
        };
      });
      return processed.filter((char) => {
        return char.all - char.incorrect;
      });
    },
    bestSpeed() {
      let chars = this.charsSegregated;
      let maxWpm = chars[0].avgWpm;
      chars.forEach((char) => {
        if (char.avgWpm > maxWpm) maxWpm = char.avgWpm;
      });
      return maxWpm;
    },
  },
  components: { CharStatistics },
};
</script>
