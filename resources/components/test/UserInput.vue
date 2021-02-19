<template>
  <v-row>
    <v-progress-linear
      :value="progress"
      :color="color"
      absolute
      height="7"
      class="mb-12"
    ></v-progress-linear>
    <v-textarea
      ref="userInput"
      v-model="input"
      @blur="deactivate()"
      @input="
        (e) => {
          typingStarted();
          updateTyped();
          checkInput();
        }
      "
      height="0px"
      style="opacity: 0"
      :disabled="!isTestRunning"
      class="ma-0 pa-0"
      autocomplete="off"
      multi-line
    >
    </v-textarea>
  </v-row>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      allErrors: 0,
      beforeKeyPress: "",
      input: "",
    };
  },
  watch: {
    typed: function (typed) {
      if (typed.length !== 0 && typed.length >= this.signs.length) {
        this.endTest();
      }
    },
    isTestActivated: function (isTestActivated) {
      if (isTestActivated) this.$refs.userInput.focus();
    },
  },
  computed: {
    ...mapGetters(["isTestActivated", "isTestRunning", "typed", "signs"]),
    progress() {
      return (this.typed.length / this.signs.length) * 100;
    },
    color() {
      return ["error", "warning", "success"][Math.floor(this.progress / 40)];
    },
  },
  methods: {
    deactivate() {
      this.$store.dispatch("deactivateTest");
    },
    typingStarted() {
      this.$emit("typingStarted");
    },
    updateTyped() {
      this.$store.dispatch("updateTyped", this.input);
    },
    endTest() {
      this.$store.dispatch("testEnded");
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
        this.allErrors++;
      this.beforeKeyPress = this.typed;
    },
  },
};
</script>