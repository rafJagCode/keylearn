<template>
  <div class="tests-analysis" v-if="tests.length > 1">
    <v-layout column justify-center align-center>
      <span class="ma-3 text-h5">Typing Speed</span>
      <result-chart :results="speeds"></result-chart>
      <span class="ma-3 text-h5">Errors</span>
      <result-chart :results="errors"></result-chart>
    </v-layout>
  </div>
  <no-data v-else></no-data>
</template>
<script>
import ResultChart from '@/components/dashboard/statistics/ResultChart';
import NoData from '@/components/utils/NoData';
import { mapGetters } from 'vuex';
export default {
  components: {
    ResultChart,
    NoData,
  },
  computed: {
    ...mapGetters(['speeds', 'errors', 'tests']),
  },
};
</script>
