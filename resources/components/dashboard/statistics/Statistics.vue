<template>
  <v-container>
        <v-card>
      <v-toolbar
        flat
        color="primary"
        dark
      >
        <v-toolbar-title>Statistics</v-toolbar-title>
      </v-toolbar>
      <v-tabs vertical>
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
          Tests Analisis
        </v-tab>
        <v-tab>
          <v-icon left>
            mdi-access-point
          </v-icon>
          Option 3
        </v-tab>

        <v-tab-item>
          <user-results></user-results>
        </v-tab-item>
        <v-tab-item>
          <typing-speed-chart></typing-speed-chart>
        </v-tab-item>
        <v-tab-item>
          <span>Lubie placki 2</span>
        </v-tab-item>
      </v-tabs>
    </v-card>
  </v-container>
</template>
<script>
import UserResults from '@/components/dashboard/statistics/UserResults';
import TypingSpeedChart from '@/components/dashboard/statistics/TypingSpeedChart';
export default {
    components:{
        UserResults,
        TypingSpeedChart
    }

}
</script>