<template>
  <v-container class="chars-statistics">
    <v-row>
      <v-col class="my-2" cols="3" v-for="charStatistics in charsStatistics" :key="charStatistics.char">
        <v-row justify="center">
          <char-statistics :charStatistics="charStatistics" :bestAvgTime="bestAvgTime"></char-statistics>
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
  components: { CharStatistics },
};
</script>
