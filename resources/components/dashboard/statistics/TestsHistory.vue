<template>
  <v-container class="tests-history" v-if="tests.length">
    <v-container>
      <v-row justify="space-around" class="mb-3">
        <v-checkbox
          v-for="checkbox in checkboxes"
          :key="checkbox.label"
          v-model="selected"
          :label="checkbox.label"
          :value="checkbox.value"
        ></v-checkbox>
      </v-row>
    </v-container>
    <v-row>
      <v-col class="my-2" cols="3" v-for="test in tests" :key="test.id">
        <v-row justify="center">
          <result :test="test" :selectedOptions="selected" @removeTestResults="removeTestResults"></result>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
  <no-data v-else></no-data>
</template>
<script>
import { mapGetters } from 'vuex';
import Result from '@/components/dashboard/statistics/Result';
import NoData from '@/components/utils/NoData';
export default {
  data() {
    return {
      checkboxes: [
        {
          label: 'Time',
          value: 'time',
        },
        {
          label: 'Score',
          value: 'score',
        },
        {
          label: 'WPM',
          value: 'wpm',
        },
        {
          label: 'All Errors',
          value: 'allErrors',
        },
        {
          label: 'Uncorrected Errors',
          value: 'uncorrectedErrors',
        },
        {
          label: 'Accuracy',
          value: 'accuracy',
        },
        {
          label: 'Test Length',
          value: 'testLength',
        },
      ],
      selected: ['time', 'wpm', 'score', 'allErrors', 'uncorrectedErrors', 'accuracy', 'testLength'],
    };
  },
  computed: {
    ...mapGetters(['user', 'tests']),
  },
  methods: {
    removeTestResults(testId) {
      Vue.axios.post('/api/delete-test-results', { id: testId }).then(() => {
        this.setResults();
      });
    },
    setResults() {
      this.$store.dispatch('setProfiles');
      this.$store.dispatch('setGeneralStatistics');
      this.$store.dispatch('setResults');
    },
  },
  components: {
    Result,
    NoData,
  },
};
</script>
