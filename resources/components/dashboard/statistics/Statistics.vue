<template>
  <div class="statistics">
        <v-card>
      <v-toolbar
        flat
        color="primaryLight"
        dark
      >
        <v-toolbar-title>Statistics</v-toolbar-title>
      </v-toolbar>
      <v-tabs vertical color="primaryLight">
        <v-tab>
          <v-icon left>
            mdi-history
          </v-icon>
          Tests history
        </v-tab>
        <v-tab>
          <v-icon left>
            mdi-chart-line
          </v-icon>
          Tests Analysis
        </v-tab>
        <v-tab>
          <v-icon left>
            mdi-access-point
          </v-icon>
          Option 3
        </v-tab>

        <v-tab-item>
          <tests-history></tests-history>
        </v-tab-item>
        <v-tab-item>
          <tests-analysis></tests-analysis>
        </v-tab-item>
        <v-tab-item>
          <span>Lubie placki 2</span>
        </v-tab-item>
      </v-tabs>
    </v-card>
  </div>
</template>
<script>
import TestsHistory from '@/components/dashboard/statistics/TestsHistory';
import TestsAnalysis from '@/components/dashboard/statistics/TestsAnalysis';
export default {
    components:{
        TestsHistory,
        TestsAnalysis
    }

}
</script>