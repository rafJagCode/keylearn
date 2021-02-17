<template>
  <v-container>
    <v-layout row>
      <v-col
        v-for="(result, index) in testResultsData"
        :key="index"
        cols="6"
        sm="4"
        class="my-4"
      >
        <v-card height="80" width="350" color="#D4D8EC">
          <v-layout row>
            <v-sheet
              color="teal"
              elevation="10"
              height="80"
              width="80"
              rounded
              class="icon"
            >
              <v-layout align-center justify-center fill-height>
                <v-icon x-large>{{ result.icon }}</v-icon>
              </v-layout>
            </v-sheet>
            <v-layout column align-center justify-center>
              <div class="name">{{ result.title }}</div>
              <div class="value">{{ result.value }}</div>
            </v-layout>
          </v-layout>
        </v-card>
      </v-col>
    </v-layout>
  </v-container>
</template>
<script>
export default {
  data: () => ({
    testResultsData: [],
  }),
  props: {
    testResults: null,
  },
  mounted() {
    this.testResultsData = [
      {
        title: "Time",
        value: this.testResults.time,
        icon: "mdi-clock-time-four-outline",
      },
      {
        title: "Test Length",
        value: this.testResults.testLength,
        icon: "mdi-ruler",
      },
      {
        title: "Errors",
        value:
          "(all/uncorrected)" +
          "\n" +
          this.testResults.allErrors +
          "/" +
          this.testResults.uncorrectedErrors,
        icon: "mdi-alert-outline",
      },
      {
        title: "Score",
        value: this.testResults.score,
        icon: "mdi-medal",
      },
      {
        title: "WPM",
        value: this.testResults.wpm,
        icon: "mdi-speedometer",
      },
      {
        title: "Accuracy",
        value: this.testResults.accuracy,
        icon: "mdi-bullseye-arrow",
      },
    ];
  },
};
</script>
<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap");

.icon {
  position: relative;
  top: -20px;
  left: 20px;
}
.name {
  font-family: "Luckiest Guy", cursive;
  font-size: 18px;
}
.value {
  text-align: center;
  white-space: pre-line;
  font-family: "Luckiest Guy", cursive;
  font-size: 13px;
}
</style>