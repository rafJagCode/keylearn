<template>
  <v-container v-if="charsStatistics.length" class="chars-statistics pt-12">
    <v-row>
      <v-col class="my-2" cols="3" v-for="charStatistics in charsStatistics" :key="charStatistics.char">
        <v-row justify="center">
          <char-statistics :charStatistics="charStatistics" :bestAvgTime="bestAvgTime"></char-statistics>
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
export default {
  computed: {
    ...mapGetters(['watchedProfile']),
    charsStatistics() {
      return this.watchedProfile.chars_statistics;
    },
    bestAvgTime() {
      let chars = this.charsStatistics;
      let bestChar = chars.reduce((prev, current) => {
        return prev.avg_time < current.avg_time ? prev : current;
      });
      return bestChar.avg_time;
    },
  },
  components: { CharStatistics, NoData },
};
</script>
