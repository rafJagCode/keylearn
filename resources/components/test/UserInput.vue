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
import { Howl, Howler } from 'howler';
export default {
  data() {
    return {
      correctSound: new Howl({
        src: [require('@/assets/sound/correct-click.mp3')],
      }),
      incorrectSound: new Howl({
        src: [require('@/assets/sound/incorrect-click.mp3')],
      }),
      timeFlags: null,
    };
  },
  mounted() {
    this.timeFlags = [...new Array(this.signs.length)];
  },
  watch: {
    typed: function (typed) {
      if (typed.length !== 0) this.timeFlags[typed.length - 1] = this.stopwatchTime;
      // this.signsTimeFlags = {
      //   ...this.signsTimeFlags,
      //   [typed.length - 1]: this.stopwatchTime,
      // };
      if (typed.length !== 0 && typed.length >= this.signs.length) {
        this.signsTimeFlags = this.timeFlags;
        this.endTest();
        this.$refs.userInput.blur();
      }
    },
    isTestActivated: function (isTestActivated) {
      if (isTestActivated) this.$refs.userInput.focus();
      if (!isTestActivated) this.$refs.userInput.blur();
    },
    signs: function (signs) {
      this.timeFlags = [...new Array(this.signs.length)];
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
    checkInput() {
      if (this.wasBackspaceClicked()) {
        this.playCorrectSound();
        this.beforeKeyPress = this.typed;
        return;
      }
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
      this.correctSound.play();
    },
    playIncorrectSound() {
      this.incorrectSound.play();
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
