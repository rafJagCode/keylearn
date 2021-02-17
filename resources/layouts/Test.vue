<template>
  <v-app id="test">
    <v-navigation-drawer
      app
      class="pa-0"
      color="secondary"
      expand-on-hover
      permanent
    >
      <v-list-item class="px-2">
        <v-list-item-avatar>
          <v-img :src="require('@/assets/img/parrot.svg')"></v-img>
        </v-list-item-avatar>
        <v-list-item-content>
          <v-list-item-title class="primaryLight--text font-weight-bold">
            Not logged in
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-list rounded dense class="text-h4">
        <v-hover v-slot="{ hover }" v-for="(item, index) in items" :key="index">
          <v-list-item
            class="px-2"
            :class="{ 'list--hover': hover }"
            link
            @click.prevent="goTo(item.link)"
          >
            <v-list-item-icon>
              <v-icon medium color="primaryLight">{{ item.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title class="primaryLight--text font-weight-bold">
                {{ item.text }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-hover>
      </v-list>
    </v-navigation-drawer>

    <v-main>
      <v-container style="width: 800px">
        <v-row>
          <v-progress-linear
            :value="progress"
            :color="color"
            absolute
            height="7"
            class="mb-12"
          ></v-progress-linear>
          <v-textarea
            ref="displayedTest"
            @blur="activate = false"
            @input="
              startClock();
              checkInput();
            "
            height="0px"
            style="opacity: 0"
            :disabled="this.$store.getters.hasTestEnded"
            v-model="typed"
            class="ma-0 pa-0"
            autocomplete="off"
            multi-line
          >
          </v-textarea>
        </v-row>
        <v-row class="justify-center">
          <stopwatch ref="stopwatch" class="mt-1"></stopwatch>
        </v-row>
        <v-layout column :style="{ opacity: !activate ? 0.3 : 1 }">
          <v-row v-for="(row, index) in rows" :key="index">
            <sign
              v-for="sign in row"
              :key="sign.position"
              :sign="sign.sign"
              :state="checkTypedSigns[sign.position]"
            >
            </sign>
          </v-row>
        </v-layout>
        <v-layout justify-center>
          <v-btn
            class="mt-2"
            small
            @click="activate = true"
            text
            v-if="!activate && !hasTestEnded"
            color="#E2DADB"
          >
            Click to activate
          </v-btn>
        </v-layout>
        <v-layout
          :style="{ visibility: hasTestEnded ? 'visible' : 'hidden' }"
          class="mt-3"
          row
          align-center
        >
          <v-btn @click="nextTest()" outlined dark block color="primaryLight">
            Next Test
            <v-icon right>mdi-arrow-right-drop-circle</v-icon>
          </v-btn>
        </v-layout>
        <v-row>
          <test-results
            v-if="hasTestEnded"
            :testResults="testResults"
          ></test-results>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import stopwatch from "@/components/utils/Stopwatch";
import sign from "@/components/utils/Sign";
import testResults from "@/components/utils/TestResults";

export default {
  data: function () {
    return {
      items: [
        {
          link: "login",
          icon: "mdi-account-outline",
          text: "Login",
        },
        {
          link: "home",
          icon: "mdi-home-outline",
          text: "Home",
        },
      ],
      activate: false,
      hasTestEnded: false,
      beforeKeyPress: "",
      typed: "",
      text: [],
      rows: [],
      testResults: {
        time: "00:00:00.000",
        testLength: 0,
        wpm: 0,
        uncorrectedErrors: 0,
        allErrors: 0,
        accuracy: 0,
        score: 0,
      },
    };
  },
  watch: {
    typed: function (typed) {
      if (typed.length >= this.signs.length) {
        this.hasTestEnded = true;
        this.stopClock();
        this.calculateTestResults();
      }
    },
    activate: function (activate) {
      if (activate) this.$refs.displayedTest.focus();
    },
  },
  computed: {
    signs() {
      let text = [];
      this.rows.forEach((row) => {
        row.forEach((sign) => {
          text.push(sign.sign);
        });
      });
      this.text = text;
      return text;
    },
    checkTypedSigns() {
      let compare = [];
      let typedSigns = this.typed.split("");
      this.signs.forEach((sign, index) => {
        if (index === typedSigns.length) compare.push("current");
        else if (index > typedSigns.length) compare.push("none");
        else if (sign !== typedSigns[index]) compare.push("incorrect");
        else compare.push("correct");
      });
      compare.push("none");
      return compare;
    },
    progress() {
      return (this.typed.length / this.text.length) * 100;
    },
    color() {
      return ["error", "warning", "success"][Math.floor(this.progress / 40)];
    },
  },
  methods: {
    goTo(link) {
      this.$router.push({ name: link });
    },
    resetData() {
      this.activate = false;
      this.hasTestEnded = false;
      this.beforeKeyPress = "";
      this.typed = "";
    },
    resetTestResults() {
      this.$store.dispatch("resetTestResults");
    },
    resetClock() {
      this.$refs.stopwatch.reset();
    },
    divideToRows(text) {
      let signsInRow = 35;
      let row = "";
      let rows = [];
      let words = text.split(" ");
      let rowLength = 0;
      for (let i = 0; i < words.length; i++) {
        if (rowLength + words[i].length < signsInRow) {
          row += words[i] + " ";
          rowLength += words[i].length + 1;
        } else {
          row = row.replace(/.$/, "\n");
          rows.push(row);
          row = "";
          row += words[i] + " ";
          rowLength = words[i].length + 1;
        }
      }
      row = row.replace(/.$/, "\n");
      rows.push(row);
      let position = 0;
      let rowsOfSigns = [];
      for (let i = 0; i < rows.length; i++) {
        let rowOfSigns = [];
        for (let j = 0; j < rows[i].length; j++) {
          let sign = {
            sign: rows[i][j],
            row: i,
            position: position,
          };
          position++;
          rowOfSigns.push(sign);
        }
        rowsOfSigns.push(rowOfSigns);
      }
      this.rows = rowsOfSigns;
    },
    getNewTest() {
      Vue.axios.post("api/new-test").then((res) => {
        this.divideToRows(res.data);
      });
    },
    startClock() {
      if (this.$refs.stopwatch.running) return;
      this.$refs.stopwatch.start();
    },
    wasBackspaceClicked() {
      if (this.beforeKeyPress.length + 1 > this.typed.length) return true;
      return false;
    },
    //Tu skończyłem prace z wykrywaniem błędów w czasie pisania
    checkInput() {
      if (this.wasBackspaceClicked()) {
        this.beforeKeyPress = this.typed;
        return;
      }
      //check
      if (this.typed.slice(-1) !== this.signs[this.typed.length - 1])
        this.testResults.allErrors++;
      this.beforeKeyPress = this.typed;
    },
    stopClock() {
      this.$refs.stopwatch.stop();
    },
    textToSeconds(text) {
      let textDivided = text.split(":");
      let seconds =
        parseFloat(textDivided[0]) * 3600 +
        parseFloat(textDivided[1]) * 60 +
        parseFloat(textDivided[2]);
      return seconds;
    },
    uncorrectedErrors() {
      let errors = 0;
      let typedSigns = this.typed.split("");
      this.signs.forEach((sign, index) => {
        if (sign !== typedSigns[index]) errors++;
      });
      return errors;
    },
    calculateTestResults() {
      let uncorrectedErrors = this.uncorrectedErrors();
      let time = this.$refs.stopwatch.time;
      let seconds = this.textToSeconds(time);
      let minutes = seconds / 60;
      let testLength = this.signs.length;
      let cpmGross = testLength / minutes;
      let wpmGross = cpmGross / 5;
      let wpmNet = wpmGross - uncorrectedErrors / minutes;
      let allErrors = this.testResults.allErrors;
      this.testResults.time = time;
      this.testResults.testLength = testLength;
      this.testResults.wpm = Math.round(wpmNet);
      this.testResults.uncorrectedErrors = uncorrectedErrors;
      this.testResults.accuracy =
        Math.round(((testLength - uncorrectedErrors) / testLength) * 100) + "%";

      //score
      let wpmWeight = 100;
      let lenghtWeight = 1;
      let errorsWeight = 10;
      this.testResults.score = Math.round(
        (wpmWeight * wpmNet +
          lenghtWeight * testLength -
          errorsWeight * allErrors) /
          (wpmWeight + lenghtWeight + errorsWeight)
      );
    },
    nextTest() {
      this.resetData();
      this.resetClock();
      this.getNewTest();
    },
  },
  components: {
    sign,
    stopwatch,
    "test-results": testResults,
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
