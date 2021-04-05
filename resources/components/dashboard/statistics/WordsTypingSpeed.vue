<template>
  <v-container class="words-typing-speed">
    <word-typing-speed
      v-for="word in sortedWords"
      :key="word.name"
      :word="word"
      :bestResult="bestResult"
    ></word-typing-speed>
  </v-container>
</template>
<script>
import { mapGetters } from 'vuex';
import WordTypingSpeed from '@/components/dashboard/statistics/WordTypingSpeed';
export default {
  components: {
    WordTypingSpeed,
  },
  computed: {
    ...mapGetters(['tests']),
    words() {
      let avgTimes = this.getAvgWordsTypingTimes();
      let words = [];
      Object.keys(avgTimes).forEach((word) => {
        words.push({ name: word, time: avgTimes[word] });
      });
      return words;
    },
    bestResult() {
      let best = this.words[0].time;
      this.words.forEach((word) => {
        if (word.time < best) best = word.time;
      });
      return best;
    },
    sortedWords() {
      let words = this.words;
      words.sort((firstWord, secondWord) => secondWord.time - firstWord.time);
      return words;
    },
  },
  methods: {
    getWordsTypingTimes() {
      return [...this.tests]
        .map((test) => {
          return test.words_typing_times;
        })
        .flat(Infinity);
    },
    getSegregatedWordsTypingTimes() {
      let times = this.getWordsTypingTimes();
      let segregated = Object.create(null);
      times.forEach((word) => {
        if (segregated[word.word]) {
          segregated[word.word] = [segregated[word.word], word.time].flat(Infinity);
        } else {
          segregated[word.word] = word.time;
        }
      });
      return segregated;
    },
    getAvgWordsTypingTimes() {
      let times = this.getSegregatedWordsTypingTimes();
      Object.keys(times).forEach((word) => {
        if (Array.isArray(times[word]))
          times[word] = times[word].reduce((sum, time) => sum + time) / times[word].length;
      });
      return times;
    },
    showWordsTypingSpeed() {
      console.log(this.words);
    },
  },
};
</script>
