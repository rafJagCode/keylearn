<template>
  <v-app id="test">
    <navigation-drawer></navigation-drawer>
    <v-main>
      <v-container style="width: 800px">
        <user-input
          ref="userInput"
          @typingStarted="typingStarted()"
        ></user-input>
        <stopwatch ref="stopwatch" class="mt-1"></stopwatch>
        <test-displayer
          :testLoading="testLoading"
        ></test-displayer>
        <v-row justify="center">
          <v-btn
            class="mt-2"
            small
            @click="activateTest()"
            text
            v-if="!isTestActivated && isTestRunning && !testLoading"
            color="#E2DADB"
          >
            Click to activate
          </v-btn>
        </v-row>
        <v-row
          :style="{ visibility: !isTestRunning ? 'visible' : 'hidden' }"
          class="mt-3"
          row
          align="center"
        >
          <v-btn @click="nextTest()" outlined dark block color="primaryLight">
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
import { mapGetters} from 'vuex'
export default {
  data: function () {
    return {
      testLoading: false,
    };
  },
  computed: {
  ...mapGetters(['isTestRunning', 'isTestActivated', 'typed', 'text'])
  },
  methods: {
    handleKeypress(){
      console.log('press');
    },
    activateTest(){
      this.$store.dispatch('activateTest');
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
      this.testLoading = true;
      Vue.axios.post("api/new-test").then((res) => {
        this.$store.dispatch('updateText', res.data);
        this.testLoading = false;
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
.list--hover {
  background-color: #323c71;
}
</style>
