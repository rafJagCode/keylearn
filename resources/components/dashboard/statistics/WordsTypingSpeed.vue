<template>
  <v-container class="words-typing-speed pt-12" v-if="wordsStatistics.length">
    <statistic-sorter @sorted="assignSorted" :data="watchedProfile.words_statistics"></statistic-sorter>
    <v-row>
      <v-col class="my-2" v-for="word in wordsStatistics" :key="word.name">
        <v-row justify="center">
          <word-typing-speed :word="word" :bestWpm="bestWpm"></word-typing-speed>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
  <no-data v-else></no-data>
</template>
<script>
import { mapGetters } from 'vuex';
import WordTypingSpeed from '@/components/dashboard/statistics/WordTypingSpeed';
import StatisticSorter from '@/components/dashboard/statistics/StatisticSorter';
import NoData from '@/components/utils/NoData';
export default {
  data() {
    return {
      sorted: null,
    };
  },
  components: {
    WordTypingSpeed,
    NoData,
    StatisticSorter,
  },
  computed: {
    ...mapGetters(['watchedProfile']),
    wordsStatistics() {
      return this.sorted === null ? this.watchedProfile.words_statistics : this.sorted;
      //   return this.watchedProfile.words_statistics;
    },
    bestWpm() {
      let best = this.wordsStatistics[0].avg_wpm;
      this.wordsStatistics.forEach((word) => {
        if (word.avg_wpm > best) best = word.avg_wpm;
      });
      return best;
    },
  },
  methods: {
    assignSorted(sorted) {
      this.sorted = sorted;
    },
  },
};
</script>
