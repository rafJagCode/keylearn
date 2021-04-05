<template>
  <v-card class="test-results pa-2" width="250px" height="250px">
    <v-card-title class="text-subtitle-1">
      <span class="font-weight-bold text-caption">DATE:</span>
      <span class="ml-2 text-caption">{{ testDate }}</span>
      <v-spacer></v-spacer>
      <v-icon @click="removeTestResults(test.id)" class="delete-button pa-1" color="red">mdi-delete-forever</v-icon>
    </v-card-title>
    <v-card-text>
      <v-row v-for="(option, name) in options" :key="name">
        <v-icon small left>{{ option.icon }}</v-icon>
        {{ option.title }} : {{ test[option.value] }}</v-row
      >
    </v-card-text>
  </v-card>
</template>
<script>
export default {
  data() {
    return {
      availAbleOptions: {
        time: {
          title: 'TIME',
          value: 'time',
          icon: 'mdi-clock-time-four-outline',
        },
        testLength: {
          title: 'TEST LENGTH',
          value: 'test_length',
          icon: 'mdi-ruler',
        },
        uncorrectedErrors: {
          title: 'UNCORRECTED ERRORS',
          value: 'uncorrected_errors',
          icon: 'mdi-alert-outline',
        },
        allErrors: {
          title: 'ALL ERRORS',
          value: 'all_errors',
          icon: 'mdi-alert-outline',
        },
        accuracy: {
          title: 'ACCURACY',
          value: 'accuracy',
          icon: 'mdi-bullseye-arrow',
        },
        score: { title: 'SCORE', value: 'score', icon: 'mdi-medal' },
        wpm: { title: 'WPM', value: 'wpm', icon: 'mdi-speedometer' },
      },
    };
  },
  props: {
    test: null,
    selectedOptions: null,
  },
  computed: {
    options() {
      let subset = Object.keys(this.availAbleOptions)
        .filter((key) => this.selectedOptions.indexOf(key) >= 0)
        .reduce((obj2, key) => Object.assign(obj2, { [key]: this.availAbleOptions[key] }), {});
      return subset;
    },
    testDate() {
      let date = new Date(this.test.created_at);
      let year = date.getFullYear();
      let month = date.toLocaleString('en', { month: 'long' }).toUpperCase();
      let day = date.getDate();
      let hours = date.getHours();
      let minutes = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
      return day + ' ' + month + ' ' + year + ' ' + hours + ':' + minutes;
    },
  },
  methods: {
    removeTestResults(testId) {
      this.$emit('removeTestResults', testId);
    },
  },
};
</script>
<style scoped>
.delete-button {
  cursor: pointer;
}
</style>
