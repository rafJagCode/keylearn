<template>
  <v-container v-if="charsStatistics.length" class="chars-statistics pt-12">
    <statistic-sorter :data="watchedProfile.chars_statistics" @sorted="assignSorted"></statistic-sorter>
    <v-row>
      <v-col class="my-2" v-for="charStatistics in charsStatistics" :key="charStatistics.char">
        <v-row justify="center">
          <char-statistics :charStatistics="charStatistics" :bestAvgWpm="bestAvgWpm"></char-statistics>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
  <no-data v-else></no-data>
</template>
<script>
import { mapGetters } from 'vuex';
import CharStatistics from '@/components/dashboard/statistics/CharStatistics.vue';
import NoData from '@/components/utils/NoData';
import StatisticSorter from '@/components/dashboard/statistics/StatisticSorter';
export default {
  data() {
    return {
      sorted: null,
    };
  },
  computed: {
    ...mapGetters(['watchedProfile']),
    charsStatistics() {
      return this.sorted === null ? this.watchedProfile.chars_statistics : this.sorted;
    },
    bestAvgWpm() {
      let chars = this.charsStatistics;
      let bestChar = chars.reduce((prev, current) => {
        return prev.avg_wpm > current.avg_wpm ? prev : current;
      });
      return bestChar.avg_time;
    },
  },
  methods: {
    assignSorted(sorted) {
      this.sorted = sorted;
    },
  },
  components: { CharStatistics, NoData, StatisticSorter },
};
</script>
