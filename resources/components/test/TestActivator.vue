<template>
  <v-row justify="center" :style="{ visibility: enableTestActivator ? 'visible' : 'hidden' }">
    <Keypress v-if="enableTestActivator" key-event="keyup" :key-code="13" @success="handleEnterKeypress()" />
    <span class="ma-0 creamy--text"> Press ENTER to activate </span>
  </v-row>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
  computed: {
    ...mapGetters(['isTestRunning', 'isTestActivated', 'errorWhileLoading', 'testLoading']),
    enableTestActivator() {
      return !this.isTestActivated && this.isTestRunning && !this.testLoading && !this.errorWhileLoading;
    },
  },
  methods: {
    handleEnterKeypress() {
      if (this.isTestActivated) return;
      this.activateTest();
    },
    activateTest() {
      this.$store.dispatch('activateTest');
    },
  },
  components: {
    Keypress: () => import('vue-keypress'),
  },
};
</script>
