<template>
  <v-container class="words-typing-speed pt-12" v-if="wordsStatistics.length">
    <v-row>
      <v-col class="my-2" cols="3" v-for="word in wordsStatistics" :key="word.name">
        <v-row justify="center">
          <word-typing-speed :word="word" :bestTime="bestTime"></word-typing-speed>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
  <no-data v-else></no-data>
</template>
<script>
import { mapGetters } from 'vuex';
import WordTypingSpeed from '@/components/dashboard/statistics/WordTypingSpeed';
import NoData from '@/components/utils/NoData';
export default {
  components: {
    WordTypingSpeed,
    NoData,
  },
  computed: {
    ...mapGetters(['watchedProfile']),
    wordsStatistics() {
      return this.watchedProfile.words_statistics;
    },
    bestTime() {
      let best = this.wordsStatistics[0].avg_time_per_key;
      this.wordsStatistics.forEach((word) => {
        if (word.avg_time_per_key < best) best = word.avg_time_per_key;
      });
      return best;
    },
    sortedWords() {
      let words = this.words;
      words.sort((firstWord, secondWord) => secondWord.avg_time_per_key - firstWord.avg_time_per_key);
      return words;
    },
  },
};
</script>
