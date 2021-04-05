<template>
  <v-icon class="sign" :class="states[state]">
    {{ displayedSign }}
  </v-icon>
</template>
<script>
export default {
  data: () => ({
    states: {
      none: 'sign--none',
      current: 'sign--current',
      correct: 'sign--correct',
      incorrect: 'sign--incorrect',
    },
  }),
  props: {
    sign: '',
    state: {
      default: 'none',
    },
  },
  computed: {
    displayedSign() {
      if (this.sign === '-') return 'mdi-minus';
      if (this.sign === ' ') return 'mdi-keyboard-space';
      if (this.sign === '\n') return 'mdi-keyboard-return';
      return this.sign;
    },
  },
};
</script>
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=PT+Mono&display=swap');
.sign {
  font-size: 20px;
  color: #e2dadb;
  font-family: 'PT Mono', monospace;
  border-radius: 10%;
  margin: 0.5px;
  width: 20px;
  height: 30px;
  text-align: center;
  vertical-align: middle;
  font-style: normal;
}
.sign--none {
  background-color: #252c55;
}
.sign--current {
  border-bottom: 2px solid #52c6f4;
}
.sign--correct {
  background-color: green;
}
.sign--incorrect {
  background-color: #cf1259;
}
</style>
