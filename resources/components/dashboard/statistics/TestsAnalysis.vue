<template>
  <div class="tests-analysis">
    <v-layout column justify-center align-center>
      <span class="ma-3 text-h5">Typing Speed</span>
      <result-chart :results="speeds"></result-chart>
      <span class="ma-3 text-h5">Errors</span>
      <result-chart :results="errors"></result-chart>
    </v-layout>
  </div>
</template>
<script>
import ResultChart from "@/components/dashboard/statistics/ResultChart";
import {mapGetters} from "vuex";
export default {
  components: {
    ResultChart,
  },
  computed:{
    ...mapGetters(["speeds", "errors"])
  }
};
</script>
