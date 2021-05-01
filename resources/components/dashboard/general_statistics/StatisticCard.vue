<template>
  <v-card class="statistic-card" :color="color" width="350px" height="180px" :style="area">
    <div class="statistic-card__details">
      <div class="statistic-card__small-icon-container">
        <div class="statistic-card__small-icon-background" :style="background">
          <v-icon class="statistic-card__small-icon">{{ smallIcon }}</v-icon>
        </div>
      </div>
      <div class="statistic-card__data">{{ data }}</div>
      <div class="statistic-card__description">{{ description }}</div>
    </div>
    <v-icon class="statistic-card__big-icon">{{ bigIcon }}</v-icon>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      background: {
        '--background': this.color,
      },
      area: {
        '--area': this.gridArea,
      },
    };
  },
  props: {
    color: null,
    smallIcon: null,
    bigIcon: null,
    data: null,
    description: null,
    gridArea: null,
  },
};
</script>

<style lang="css" scoped>
.statistic-card {
  padding: 15px;
  display: flex;
  flex-wrap: wrap;
  color: white;
  grid-area: var(--area);
}
.statistic-card__details {
  flex-basis: 50%;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.statistic-card__small-icon-container {
  margin-bottom: 15px;
}
.statistic-card__small-icon-background {
  padding: 15px;
  background: var(--background);
  border-radius: 50%;
  width: min-content;
  filter: brightness(1.1);
}
.statistic-card__small-icon {
  font-size: 25px;
  color: white;
}
.statistic-card__data {
  font-size: 25px;
}
.statistic-card__description {
  font-size: 15px;
}
.statistic-card__big-icon {
  color: white;
  font-size: 140px;
  flex-basis: 50%;
  justify-self: center;
}
</style>
