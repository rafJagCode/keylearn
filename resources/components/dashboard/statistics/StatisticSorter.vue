<template>
  <div class="statistic-sorter">
    <v-btn v-for="option in options" :key="option.name" class="statistic-sorter__btn" @click="sort(option.property)"
      >{{ option.name }}<v-icon right>mdi-chevron-up</v-icon></v-btn
    >
  </div>
</template>

<script>
export default {
  data() {
    return {
      options: [
        {
          name: 'wpm',
          icon: 'mdi-chevron-up',
          property: 'avg_time_per_key',
        },
        {
          name: 'accuracy',
          icon: 'mdi-chevron-up',
          property: 'accuracy',
        },
        {
          name: 'samples',
          icon: 'mdi-chevron-up',
          property: 'samples',
        },
      ],
    };
  },
  props: {
    data: null,
  },
  methods: {
    sort(property) {
      let sorted = this.data.sort((current, next) => current[property] - next[property]);
      this.$emit('sorted', sorted);
    },
  },
};
</script>

<style lang="css" scoped>
.statistic-sorter {
  display: flex;
  justify-items: left;
  align-items: center;
  padding: 10px;
}
.statistic-sorter__btn {
  margin: 0 5px;
}
</style>
