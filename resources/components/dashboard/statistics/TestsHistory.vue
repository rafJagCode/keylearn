<template>
  <v-container class="tests-history" v-if="tests.length">
    <v-btn color="error" @click="removeAll()" text x-large>REMOVE ALL <v-icon>mdi-delete-forever</v-icon></v-btn>
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
    <v-row justify="start">
      <v-col class="tests-history__result-col ma-2" v-for="test in tests" :key="test.id">
        <v-row justify="center">
          <result :test="test" :selectedOptions="selected" @removeTestResults="removeTestResults"></result>
        </v-row>
      </v-col>
      <v-spacer></v-spacer>
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
      removing: false,
    };
  },
  computed: {
    ...mapGetters(['user', 'tests', 'watchedProfile']),
  },
  methods: {
    removeTestResults(testId) {
      if (this.removing) return;
      Vue.$confirm({
        title: 'Delete Result',
        message: 'Do you realy want to delete this result?',
        button: {
          yes: 'YES',
          no: 'NO',
        },
        /**
         * Callback Function
         * @param {Boolean} confirm
         */
        callback: (confirm) => {
          if (confirm) {
            this.removing = true;
            Vue.axios.post('/api/delete-test-results', { id: testId }).then(async () => {
              await this.setResults();
              this.removing = false;
            });
          }
        },
      });
    },
    removeAll() {
      if (this.removing) return;
      Vue.$confirm({
        title: 'Delete All Results',
        message: 'Do you realy want to delete all results?',
        button: {
          yes: 'YES',
          no: 'NO',
        },
        /**
         * Callback Function
         * @param {Boolean} confirm
         */
        callback: (confirm) => {
          if (confirm) {
            this.removing = true;
            Vue.axios.post('/api/delete-profile-results', { id: this.watchedProfile.id }).then(async () => {
              await this.setResults();
              this.removing = false;
            });
          }
        },
      });
    },
    async setResults() {
      await this.$store.dispatch('setProfiles');
      await this.$store.dispatch('setGeneralStatistics');
      await this.$store.dispatch('setResults');
    },
  },
  components: {
    Result,
    NoData,
  },
};
</script>
<style scoped>
.tests-history__result-col {
  flex-grow: 0;
}
</style>
