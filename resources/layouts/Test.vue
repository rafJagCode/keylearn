<template>
  <v-app id="test" color="primary">
    <Keypress key-event="keyup" :key-code="13" @success="handleKeypress()" />
    <navigation-drawer></navigation-drawer>
    <v-main>
      <v-container style="width: 800px">
        <user-input
          ref="userInput"
          @typingStarted="typingStarted()"
        ></user-input>
        <stopwatch ref="stopwatch" class="mt-1"></stopwatch>
        <v-row justify="center">
          <span
            class="ma-0 creamy--text"
            :style="{
              visibility:
                !isTestActivated && isTestRunning && !testLoading && !errorWhileLoading
                  ? 'visible'
                  : 'hidden',
            }"
          >
            Press ENTER to activate
          </span>
        </v-row>
        <test-loading-error-alert v-if="errorWhileLoading"></test-loading-error-alert>
        <test-displayer :testLoading="testLoading" v-if='!errorWhileLoading'></test-displayer>
        <v-row>
          <v-btn @click="nextTest()" outlined dark block color="primaryLight" class="mt-8">
            Next Test
            <v-icon right>mdi-arrow-right-drop-circle</v-icon>
          </v-btn>
        </v-row>
        <test-results
          v-if="!isTestRunning"
          :time="$refs.stopwatch.time"
          :allErrors="$refs.userInput.allErrors"
        ></test-results>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import Stopwatch from "@/components/test/Stopwatch";
import TestResults from "@/components/test/TestResults";
import NavigationDrawer from "@/components/test/NavigationDrawer";
import UserInput from "@/components/test/UserInput";
import TestDisplayer from "@/components/test/TestDisplayer";
import TestLoadingErrorAlert from "@/components/test/TestLoadingErrorAlert";
import { mapGetters } from "vuex";
export default {
  data: function () {
    return {
      testLoading: false,
      errorWhileLoading: false,
    };
  },
  computed: {
    ...mapGetters(["isTestRunning", "isTestActivated", "typed", "text"]),
  },
  methods: {
    handleKeypress() {
      if (this.isTestActivated) return;
      this.activateTest();
    },
    activateTest() {
      if(this.errorWhileLoading) return;
      this.$store.dispatch("activateTest");
    },
    startClock() {
      this.$refs.stopwatch.start();
    },
    typingStarted() {
      this.startClock();
    },
    resetData() {
      this.$store.dispatch("resetTestData");
      this.$refs.userInput.beforeKeyPress = "";
      this.$refs.userInput.input = "";
      this.$refs.userInput.allErrors = 0;
    },
    resetClock() {
      this.$refs.stopwatch.reset();
    },
    getNewTest() {
      this.errorWhileLoading = false;
      this.testLoading = true;
      Vue.axios
        .post("api/new-test")
        .then((res) => {
          this.$store.dispatch("updateText", res.data);
          this.testLoading = false;
        })
        .catch(() => {
          this.testLoading = false;
          this.errorWhileLoading = true;
        });
    },
    nextTest() {
      this.resetData();
      this.resetClock();
      this.getNewTest();
    },
    // resetTestResults() {
    //   this.$store.dispatch("resetTestResults");
    // },
  },
  components: {
    Stopwatch,
    TestResults,
    NavigationDrawer,
    UserInput,
    TestDisplayer,
    Keypress: () => import("vue-keypress"),
    TestLoadingErrorAlert
  },
  mounted() {
    this.getNewTest();
  },
};
</script>
<style scoped>
#test {
  background-color: #252c55;
}
</style>
