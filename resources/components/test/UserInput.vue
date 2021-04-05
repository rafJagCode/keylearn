<template>
  <v-row>
    <v-progress-linear :value="progress" :color="color" absolute height="7" class="mb-12"></v-progress-linear>
    <v-textarea
      ref="userInput"
      v-model="typed"
      :disabled="!isTestRunning"
      class="user-input"
      autocomplete="off"
      multi-line
      @blur="deactivate()"
      @input="handleInput()"
    >
    </v-textarea>
  </v-row>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
  watch: {
    typed: function (typed) {
      if (typed.length !== 0)
        this.signsTimeFlags = {
          ...this.signsTimeFlags,
          [typed.length - 1]: this.stopwatchTime,
        };
      if (typed.length !== 0 && typed.length >= this.signs.length) {
        this.endTest();
      }
    },
    isTestActivated: function (isTestActivated) {
      if (isTestActivated) this.$refs.userInput.focus();
      if (!isTestActivated) this.$refs.userInput.blur();
    },
  },
  computed: {
    ...mapGetters(['isTestActivated', 'isTestRunning', 'signs', 'stopwatchTime']),
    signsTimeFlags: {
      get() {
        return this.$store.getters.signsTimeFlags;
      },
      set(signsTimeFlags) {
        this.$store.dispatch('setSignsTimeFlags', signsTimeFlags);
      },
    },
    errorsPositions: {
      get() {
        return this.$store.getters.errorsPositions;
      },
      set(errorsPositions) {
        this.$store.dispatch('setErrorsPositions', errorsPositions);
      },
    },
    typed: {
      get() {
        return this.$store.getters.typed;
      },
      set(typed) {
        this.$store.dispatch('updateTyped', typed);
      },
    },
    beforeKeyPress: {
      get() {
        return this.$store.getters.beforeKeyPress;
      },
      set(beforeKeyPress) {
        this.$store.dispatch('updateBeforeKeyPress', beforeKeyPress);
      },
    },
    progress() {
      return (this.typed.length / this.signs.length) * 100;
    },
    color() {
      return ['error', 'warning', 'success'][Math.floor(this.progress / 40)];
    },
  },
  methods: {
    handleInput() {
      this.typingStarted();
      this.checkInput();
    },
    deactivate() {
      this.$store.dispatch('deactivateTest');
    },
    typingStarted() {
      this.$emit('typingStarted');
    },
    endTest() {
      this.$store.dispatch('testEnded');
    },
    wasBackspaceClicked() {
      if (this.beforeKeyPress.length + 1 > this.typed.length) return true;
      return false;
    },
    //Tu skończyłem prace z wykrywaniem błędów w czasie pisania
    checkInput() {
      if (this.wasBackspaceClicked()) {
        this.playCorrectSound();
        this.beforeKeyPress = this.typed;
        return;
      }
      //check
      if (this.typed.slice(-1) !== this.signs[this.typed.length - 1]) {
        this.playIncorrectSound();
        this.$store.dispatch('incrementErrorCounter');
        this.errorsPositions.push(this.typed.length - 1);
        this.beforeKeyPress = this.typed;
        return;
      }
      this.playCorrectSound();
      this.beforeKeyPress = this.typed;
    },
    playCorrectSound() {
      new Audio(require('@/assets/sound/correct-click.mp3')).play();
    },
    playIncorrectSound() {
      new Audio(require('@/assets/sound/incorrect-click.mp3')).play();
    },
  },
};
</script>
<style scoped>
.user-input {
  height: 0;
  padding: 0;
  overflow: hidden;
}
</style>
