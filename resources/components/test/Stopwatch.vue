<template>
  <v-row class="mt-4 justify-center">
    <div id="stopwatch">
      <span class="time">{{ time }}</span>
    </div>
  </v-row>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
  data() {
    return {
      time: '00:00:00.000',
      timeBegan: null,
      timeStopped: null,
      stoppedDuration: 0,
      started: null,
      running: false,
    };
  },
  watch: {
    isTestRunning: function (isTestRunning) {
      if (!isTestRunning) this.stop();
    },
    isTestActivated: function (isTestActivated) {
      if (!isTestActivated) this.stop();
    },
    time: function (time) {
      this.stopwatchTime = time;
    },
  },
  computed: {
    ...mapGetters(['isTestRunning', 'isTestActivated']),
    stopwatchTime: {
      get() {
        return this.$store.getters.stopwatchTime;
      },
      set(time) {
        this.$store.dispatch('setStopwatchTime', time);
      },
    },
  },
  methods: {
    start() {
      if (this.running) return;

      if (this.timeBegan === null) {
        this.reset();
        this.timeBegan = new Date();
      }

      if (this.timeStopped !== null) {
        this.stoppedDuration += new Date() - this.timeStopped;
      }

      this.started = setInterval(this.clockRunning, 10);
      this.running = true;
    },
    stop() {
      this.running = false;
      this.timeStopped = new Date();
      clearInterval(this.started);
    },
    reset() {
      this.running = false;
      clearInterval(this.started);
      this.stoppedDuration = 0;
      this.timeBegan = null;
      this.timeStopped = null;
      this.time = '00:00:00.000';
      this.stopwatchTime = '00:00:00.000';
    },
    clockRunning() {
      let currentTime = new Date(),
        timeElapsed = new Date(currentTime - this.timeBegan - this.stoppedDuration),
        hour = timeElapsed.getUTCHours(),
        min = timeElapsed.getUTCMinutes(),
        sec = timeElapsed.getUTCSeconds(),
        ms = timeElapsed.getUTCMilliseconds();

      this.time =
        this.zeroPrefix(hour, 2) +
        ':' +
        this.zeroPrefix(min, 2) +
        ':' +
        this.zeroPrefix(sec, 2) +
        '.' +
        this.zeroPrefix(ms, 3);
    },
    zeroPrefix(num, digit) {
      let zero = '';
      for (var i = 0; i < digit; i++) {
        zero += '0';
      }
      return (zero + num).slice(-digit);
    },
  },
};
</script>
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap');
#stopwatch {
  order: 0;
  flex: 0 1 auto;
  align-self: center;
  color: rgb(200, 200, 200);
}
.time {
  font-family: 'Share Tech Mono', monospace;
  font-size: 2em;
}
</style>
