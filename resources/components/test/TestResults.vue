<template>
  <v-row>
    <v-col v-for="(result, index) in testResultsData" :key="index" cols="6" sm="4" class="my-4">
      <v-card height="80" width="350" color="#D4D8EC">
        <v-layout row>
          <v-sheet color="teal" elevation="10" height="80" width="80" rounded class="icon">
            <v-layout align-center justify-center fill-height>
              <v-icon x-large>{{ result.icon }}</v-icon>
            </v-layout>
          </v-sheet>
          <v-layout column align-center justify-center>
            <div class="name">{{ result.title }}</div>
            <div class="value">{{ result.value }}</div>
          </v-layout>
        </v-layout>
      </v-card>
    </v-col>
  </v-row>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
  data: () => ({
    charsTypingTimes: {},
    testResultsData: [],
    testResults: {
      time: '00:00:00.000',
      testLength: 0,
      wpm: 0,
      uncorrectedErrors: 0,
      allErrors: 0,
      accuracy: 0,
      score: 0,
      wordsTypingTimes: null,
      charsStatistics: null,
    },
  }),
  computed: {
    ...mapGetters(['typed', 'signs', 'errorCounter', 'signsTimeFlags', 'errorsPositions', 'stopwatchTime']),
  },
  methods: {
    getCalculatedSignsTypingTimes() {
      const length = Object.keys(this.signsTimeFlags).length;
      let signsTypingTimes = [];
      signsTypingTimes.push(this.textToSeconds(this.signsTimeFlags[0]));
      for (let i = 1; i < length; i++) {
        let time = this.textToSeconds(this.signsTimeFlags[i]) - this.textToSeconds(this.signsTimeFlags[i - 1]);
        signsTypingTimes.push(time);
      }
      return signsTypingTimes;
    },
    getAssignedCharTypingTimes() {
      let times = this.getCalculatedSignsTypingTimes();
      let charTypingTimes = [];
      for (let i = 0; i < times.length; i++) {
        let charTypingTime = { char: this.signs[i], time: times[i] };
        charTypingTimes.push(charTypingTime);
      }
      return charTypingTimes;
    },
    getCharsTimesAndCorrectness() {
      let charTimes = this.getAssignedCharTypingTimes();
      let withoutErrors = charTimes.map((object, index) => {
        let correctness = !this.errorsPositions.includes(index);
        return { ...object, correct: correctness };
      });
      withoutErrors.shift();
      return withoutErrors;
    },
    getWordsStatistics() {
      let chars = this.getCharsTimesAndCorrectness();
      let wordsStatisitcs = [];
      let word = '';
      let time = 0;
      let errors = 0;
      chars.forEach((object) => {
        if (object.char !== ' ' && object.char !== '\n') {
          word += object.char;
          time += object.time;
          errors += object.correct ? 0 : 1;
        } else {
          wordsStatisitcs.push({
            word: word,
            avgTimePerKey: time / word.length,
            errors: errors,
          });
          word = '';
          time = 0;
          errors = 0;
        }
      });
      wordsStatisitcs.shift();
      return wordsStatisitcs;
    },
    textToSeconds(text) {
      let textDivided = text.split(':');
      let seconds = parseFloat(textDivided[0]) * 3600 + parseFloat(textDivided[1]) * 60 + parseFloat(textDivided[2]);
      return seconds;
    },
    uncorrectedErrors() {
      let errors = 0;
      let typedSigns = this.typed.split('');
      this.signs.forEach((sign, index) => {
        if (sign !== typedSigns[index]) errors++;
      });
      return errors;
    },
    calculateTestResults() {
      let uncorrectedErrors = this.uncorrectedErrors();
      let time = this.stopwatchTime;
      let seconds = this.textToSeconds(time);
      let minutes = seconds / 60;
      let testLength = this.signs.length;
      let cpmGross = testLength / minutes;
      let wpmGross = cpmGross / 5;
      let wpmNet = wpmGross - uncorrectedErrors / minutes;
      let allErrors = this.errorCounter;
      this.testResults.time = time;
      this.testResults.testLength = testLength;
      this.testResults.wpm = Math.round(wpmNet);
      this.testResults.uncorrectedErrors = uncorrectedErrors;
      this.testResults.allErrors = allErrors;
      this.testResults.accuracy = Math.round(((testLength - allErrors) / testLength) * 100);

      //score
      let wpmWeight = 100;
      let lenghtWeight = 1;
      let errorsWeight = 10;
      this.testResults.score = Math.round(
        (wpmWeight * wpmNet + lenghtWeight * testLength - errorsWeight * allErrors) /
          (wpmWeight + lenghtWeight + errorsWeight),
      );
      //Chars and words typing times
      this.testResults.wordsTypingTimes = this.getWordsStatistics();
      this.testResults.charsStatistics = this.getCharsTimesAndCorrectness();
    },
  },
  mounted() {
    this.calculateTestResults();
    this.$store.dispatch('saveTestResultsInStore', this.testResults);
    this.testResultsData = [
      {
        title: 'Time',
        value: this.testResults.time,
        icon: 'mdi-clock-time-four-outline',
      },
      {
        title: 'Test Length',
        value: this.testResults.testLength,
        icon: 'mdi-ruler',
      },
      {
        title: 'Errors',
        value: '(all/uncorrected)' + '\n' + this.testResults.allErrors + '/' + this.testResults.uncorrectedErrors,
        icon: 'mdi-alert-outline',
      },
      {
        title: 'Score',
        value: this.testResults.score,
        icon: 'mdi-medal',
      },
      {
        title: 'WPM',
        value: this.testResults.wpm,
        icon: 'mdi-speedometer',
      },
      {
        title: 'Accuracy',
        value: this.testResults.accuracy + '%',
        icon: 'mdi-bullseye-arrow',
      },
    ];
  },
};
</script>
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap');

.icon {
  position: relative;
  top: -20px;
  left: 20px;
}
.name {
  font-family: 'Luckiest Guy', cursive;
  font-size: 18px;
}
.value {
  text-align: center;
  white-space: pre-line;
  font-family: 'Luckiest Guy', cursive;
  font-size: 13px;
}
</style>
