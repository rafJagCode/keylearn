<template>
  <v-card class="ma-1">
    <v-row justify="center" align="center">
      <div class="chart-container">
        <result-chart
          ref="typingSpeedChart"
          :chart-data="datacollection"
          :options="options"
        ></result-chart>
      </div>
    </v-row>
  </v-card>
</template>

<script>
import ResultChart from "@/components/dashboard/statistics/ResultChart";

export default {
  components: {
    ResultChart,
  },
  data() {
    return {
      results: [1,2],
      minInResults: 0,
      maxInResults: 0,
      datacollection: {},
      options: {}
    };
  },
  mounted() {
    this.results = this.getData();
    this.minInResults = Math.min(...this.results);
    this.maxInResults = Math.max(...this.results);
    this.fillOptions();
    this.fillData();
  },
  methods: {
    fillOptions(){
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
          yAxes: [
            {
              ticks: {
                suggestedMin: this.minInResults - 10,
                suggestedMax: this.maxInResults + 10,
              },
            },
          ],
        },
        elements: {
          point: {
            radius: 1,
          },
        },
      }
    },
    fillData() {
      this.datacollection = {
        labels: this.getLabels(),
        datasets: [
          {
            data: this.results,
            backgroundColor: this.getGradient(),
            fill: true,
          },
        ],
      };
    },
    getGradient() {
      let gradient = this.$refs.typingSpeedChart.$refs.canvas
        .getContext("2d")
        .createLinearGradient(500, 0, 100, 0);
      gradient.addColorStop(0, "rgba(128, 182, 244, 0.6)");
      gradient.addColorStop(1, "rgba(244, 144, 128, 0.6)");
      return gradient;
    },
    getData() {
      let data = Array.from({ length: 20 }, () =>
        Math.floor(Math.random() * (40 - 35) + 39)
      );
      return data;
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
  width: 80%;
}
</style>