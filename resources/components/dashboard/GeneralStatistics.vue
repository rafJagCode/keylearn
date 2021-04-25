<template>
  <div class="general-statistics">{{ generalStatistics }}</div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
  computed: {
    ...mapGetters(['generalStatistics']),
  },
};
</script>

<style lang="scss" scoped></style>
