<template>
  <v-card outlined width="90%" class="ma-2" color="transparent">
    <v-row class="my-3" justify="center" align="center">
      <div class="chart-container">
        <chart :chart-data="datacollection" :options="options"></chart>
      </div>
    </v-row>
  </v-card>
</template>

<script>
import Chart from '@/components/dashboard/statistics/Chart';

export default {
  components: {
    Chart,
  },
  data() {
    return {
      minInResults: 0,
      maxInResults: 0,
      datacollection: {},
      options: {},
    };
  },
  props: {
    results: null,
  },
  watch: {
    results: function () {
      this.minInResults = Math.min(...this.results);
      this.maxInResults = Math.max(...this.results);
      this.fillOptions();
      this.fillData();
    },
  },
  mounted() {
    this.minInResults = Math.min(...this.results);
    this.maxInResults = Math.max(...this.results);
    this.fillOptions();
    this.fillData();
  },
  methods: {
    fillOptions() {
      this.options = {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false,
        },
        tooltips: {
          custom: function (tooltip) {
            if (!tooltip) return;
            // disable displaying the color box;
            tooltip.displayColors = false;
          },
          callbacks: {
            title: function () {
              return null;
            },
            label: function (tooltipItem) {
              return tooltipItem.yLabel;
            },
          },
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                display: false,
              },
            },
          ],
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
              },
              gridLines: {
                display: false,
              },
            },
          ],
        },
        elements: {
          point: {
            radius: 2,
          },
        },
      };
    },
    fillData() {
      this.datacollection = {
        labels: this.getLabels(),
        datasets: [
          {
            data: this.results,
            showLine: true,
            pointBackgroundColor: 'red',
          },
        ],
      };
    },
    getLabels() {
      let labels = [];
      for (let i = 1; i <= this.results.length; i++) labels.push(i);
      return labels;
    },
  },
};
</script>
<style scoped>
.chart-container {
  width: 90%;
}
</style>
