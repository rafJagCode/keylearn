<template>
  <div class="statistic-sorter">
    <v-btn
      v-for="button in buttons"
      :key="button.name"
      class="statistic-sorter__btn"
      @click="sort(button)"
      :color="button.active ? 'primaryLight' : ''"
      >{{ button.name
      }}<v-icon right>{{ button.order === 'ASC' ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon></v-btn
    >
  </div>
</template>

<script>
export default {
  data() {
    return {
      buttons: [
        {
          name: 'wpm',
          property: 'avg_wpm',
          active: false,
          order: 'ASC',
        },
        {
          name: 'accuracy',
          property: 'accuracy',
          active: false,
          order: 'ASC',
        },
        {
          name: 'samples',
          property: 'samples',
          active: false,
          order: 'ASC',
        },
      ],
    };
  },
  props: {
    data: null,
  },
  methods: {
    activateButton(button) {
      this.buttons.forEach((button) => {
        button.active = false;
      });
      button.active = true;
    },
    changeOrder(button) {
      if (button.order === 'ASC') {
        button.order = 'DESC';
        return;
      }
      if (button.order === 'DESC') button.order = 'ASC';
    },
    sort(button) {
      let property = button.property;
      if (button.active) {
        this.changeOrder(button);
      }
      if (!button.active) {
        this.activateButton(button);
      }
      if (button.order === 'ASC') {
        let sorted = this.data.sort((current, next) => current[property] - next[property]);
        this.$emit('sorted', sorted);
      }
      if (button.order === 'DESC') {
        let sorted = this.data.sort((current, next) => next[property] - current[property]);
        this.$emit('sorted', sorted);
      }
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
