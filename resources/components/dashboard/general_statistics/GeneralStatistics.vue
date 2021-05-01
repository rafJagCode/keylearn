<template>
  <div v-if="generalStatistics" class="general-statistics">
    <div class="v-card v-sheet theme--light">
      <header class="v-sheet theme--dark v-toolbar v-toolbar--flat primaryLight" style="height: 64px">
        <div class="v-toolbar__content" style="height: 64px">
          <div class="v-toolbar__title">General Statistics</div>
        </div>
      </header>
      <div class="v-window__container">
        <div class="general-statistics__cards-container">
          <statistic-card
            v-for="item in statistics"
            :key="item.description"
            :color="item.color"
            :smallIcon="item.smallIcon"
            :bigIcon="item.bigIcon"
            :data="item.data"
            :description="item.description"
            :gridArea="item.gridArea"
          ></statistic-card>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import StatisticCard from '@/components/dashboard/general_statistics/StatisticCard';
import { mapGetters } from 'vuex';
export default {
  data() {
    return {};
  },
  computed: {
    ...mapGetters(['generalStatistics']),
    statistics() {
      return [
        {
          color: '#a288e3',
          smallIcon: 'mdi-chart-line',
          bigIcon: 'mdi-speedometer',
          data:
            this.generalStatistics.averageWpm !== null
              ? this.roundTwoPlaces(this.generalStatistics.averageWpm)
              : 'No Data',
          description: 'Average WPM',
          gridArea: 'first',
        },
        {
          color: '#414770',
          smallIcon: 'mdi-chart-line',
          bigIcon: 'mdi-bullseye-arrow',
          data:
            this.generalStatistics.averageAccuracy !== null
              ? this.roundTwoPlaces(this.generalStatistics.averageAccuracy) + '%'
              : 'No Data',
          description: 'Average Accuracy',
          gridArea: 'second',
        },
        {
          color: '#7b1e7a',
          smallIcon: 'mdi-chart-line',
          bigIcon: 'mdi-file-word-box-outline',
          data: this.generalStatistics.wordsCount !== null ? this.generalStatistics.wordsCount : 'No Data',
          description: 'Words that you typed',
          gridArea: 'third',
        },
        {
          color: '#87255b',
          smallIcon: 'mdi-chart-line',
          bigIcon: 'mdi-alpha-a-box-outline',
          data: this.generalStatistics.charsCount !== null ? this.generalStatistics.charsCount : 'No Data',
          description: 'Chars that you typed',
          gridArea: 'fourth',
        },
      ];
    },
  },
  methods: {
    roundTwoPlaces(num) {
      return Math.round((Number.parseFloat(num) + Number.EPSILON) * 100) / 100;
    },
  },
  components: {
    StatisticCard,
  },
};
</script>

<style lang="css" scoped>
.general-statistics__cards-container {
  min-height: calc(100vh - 80px);
  grid-template-areas:
    '. . . .'
    '. first second .'
    '. third fourth .'
    '. . . .';
  display: grid;
  grid-template-columns: auto 400px 400px auto;
  grid-template-rows: auto 230px 230px auto;
  place-items: center;
}
</style>
