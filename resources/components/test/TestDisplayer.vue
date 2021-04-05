<template>
  <v-layout align-center class="test-displayer">
    <test-loading-error-alert v-if="errorWhileLoading"></test-loading-error-alert>
    <v-container v-if="!errorWhileLoading">
      <v-row align="center" justify="center">
        <v-progress-circular
          class="mb-8"
          v-if="testLoading"
          :size="50"
          color="primary"
          indeterminate
        ></v-progress-circular>
      </v-row>
      <v-layout v-show="!testLoading" column :style="{ opacity: !isTestActivated ? 0.3 : 1 }">
        <v-row v-for="(row, index) in rows" :key="index">
          <sign v-for="sign in row" :key="sign.position" :sign="sign.sign" :state="checkTypedSigns[sign.position]">
          </sign>
        </v-row>
      </v-layout>
    </v-container>
  </v-layout>
</template>
<script>
import TestLoadingErrorAlert from '@/components/test/TestLoadingErrorAlert';
import Sign from '@/components/test/Sign';
import { mapGetters } from 'vuex';
export default {
  data() {
    return {
      rows: [],
    };
  },
  watch: {
    text: function (text) {
      this.divideToRows(text);
      this.createSignsArray();
    },
  },
  computed: {
    ...mapGetters(['isTestActivated', 'text', 'typed', 'signs', 'testLoading', 'errorWhileLoading']),
    checkTypedSigns() {
      let compare = [];
      let typedSigns = this.typed.split('');
      this.signs.forEach((sign, index) => {
        if (index === typedSigns.length) compare.push('current');
        else if (index > typedSigns.length) compare.push('none');
        else if (sign !== typedSigns[index]) compare.push('incorrect');
        else compare.push('correct');
      });
      compare.push('none');
      return compare;
    },
  },
  methods: {
    divideToRows(text) {
      let signsInRow = 36;
      let row = '';
      let rows = [];
      let words = text.split(' ');
      let rowLength = 0;
      for (let i = 0; i < words.length; i++) {
        if (rowLength + words[i].length < signsInRow) {
          row += words[i] + ' ';
          rowLength += words[i].length + 1;
        } else {
          row = row.replace(/.$/, '\n');
          rows.push(row);
          row = '';
          row += words[i] + ' ';
          rowLength = words[i].length + 1;
        }
      }
      row = row.replace(/.$/, '\n');
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
    createSignsArray() {
      let signs = [];
      this.rows.forEach((row) => {
        row.forEach((sign) => {
          signs.push(sign.sign);
        });
      });
      this.$store.dispatch('updateSigns', signs);
    },
  },
  components: {
    Sign,
    TestLoadingErrorAlert,
  },
};
</script>
<style scoped>
.test-displayer {
  height: 200px;
}
</style>
