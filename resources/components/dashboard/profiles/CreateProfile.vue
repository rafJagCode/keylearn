<template>
  <v-container class="create-profile">
    <v-snackbar v-model="created" :timeout="1000" centered>
      <v-row align="center" justify="space-around">
        <span class="ml-3">Profile Created</span>
        <v-spacer></v-spacer>
        <v-btn text color="primaryLight" @click.native="created = false">Close</v-btn>
      </v-row>
    </v-snackbar>
    <v-alert type="error" v-if="error">{{ error }}</v-alert>
    <v-text-field label="Profile Name" v-model="profileName" :rules="rules" width="30%"></v-text-field>
    <v-slider
      v-model="testLength"
      thumb-label="always"
      step="5"
      ticks
      min="10"
      max="50"
      label="Test Length(in words)"
      class="pt-6"
    ></v-slider>
    <v-radio-group v-model="wordSelection">
      <v-radio label="Use Random Words" value="random"></v-radio>
      <v-radio label="Define Own Words" value="defined"></v-radio>
    </v-radio-group>
    <v-checkbox v-if="!useWordsFromApi" label="Enable Auto Difficulty" v-model="isAutoDifficultyEnabled"></v-checkbox>
    <div v-if="!useWordsFromApi" class="create-profile__words-settings">
      <v-card class="create-profile__user-words">
        <textarea
          class="create-profile__textarea"
          id="scrollable"
          placeholder="Write here words that you would like to add"
          v-model="wordsField"
        ></textarea>
      </v-card>
      <v-img
        :src="require('@/assets/img/add-words-arrow.png')"
        class="create-profile__add-words-arrow"
        @click="addWords()"
      ></v-img>
      <v-card class="create-profile__virtual-scroll">
        <v-virtual-scroll :bench="5" :items="wordsToAdd" item-height="34" id="scrollable">
          <template v-slot:default="{ item }">
            <v-list-item :key="item">
              <v-list-item-content>
                <v-chip outlined label close @click:close="removeWord(item)">{{ item }}</v-chip>
              </v-list-item-content>
            </v-list-item>
          </template>
        </v-virtual-scroll>
      </v-card>
    </div>
    <v-row class="my-3">
      <v-spacer></v-spacer>
      <v-progress-circular indeterminate color="primaryLight" class="mr-2" v-if="creating"></v-progress-circular>
      <v-btn @click="createProfile()"> Create Profile</v-btn>
    </v-row>
  </v-container>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
  data() {
    return {
      created: false,
      creating: false,
      error: null,
      wordsField: '',
      wordsToAdd: [],
      profileName: '',
      wordSelection: 'random',
      isAutoDifficultyEnabled: false,
      testLength: 10,
      rules: [(value) => !!value || 'Required.', (value) => (value || '').length <= 20 || 'Max 20 characters'],
    };
  },
  watch: {
    useWordsFromApi: function (useWordsFromApi) {
      if (!useWordsFromApi) return;
      this.isAutoDifficultyEnabled = false;
    },
  },
  computed: {
    useWordsFromApi() {
      return this.wordSelection === 'random' ? true : false;
    },
  },
  methods: {
    createProfile() {
      this.creating = true;
      this.error = null;
      Vue.axios
        .post('/api/create-profile', {
          name: this.profileName,
          words: this.wordsToAdd,
          useWordsFromApi: this.useWordsFromApi,
          isAutoDifficultyEnabled: this.isAutoDifficultyEnabled,
          testLength: this.testLength,
        })
        .then(() => {
          this.$store.dispatch('setProfiles');
          this.created = true;
        })
        .catch((error) => {
          this.error = error.response.data.message;
        });
      this.creating = false;
    },
    addWords() {
      let words = this.wordsField.trim().split(/\s+/);
      words.forEach((word) => {
        if (!this.wordsToAdd.includes(word)) {
          this.wordsToAdd.push(word);
        }
      });
    },
    removeWord(item) {
      this.wordsToAdd = this.wordsToAdd.filter((word) => {
        return word !== item;
      });
    },
  },
};
</script>
<style scoped>
.create-profile__words-settings {
  height: 250px;
  display: grid;
  grid-template-columns: 4fr 1fr 4fr;
  margin-bottom: 20px;
}
.create-profile__user-words {
  grid-row-start: 1;
  grid-row-end: 2;
  padding: 10px;
}
.create-profile__textarea {
  height: 100%;
  width: 100%;
  border: none;
  background-color: transparent;
  outline: none;
  resize: none;
}
.create-profile__add-words-arrow {
  height: 40px;
  width: 40px;
  align-self: center;
  justify-self: center;
  cursor: pointer;
  transition-duration: 200ms;
}
.create-profile__add-words-arrow:hover {
  height: 45px;
  width: 45px;
}
.create-profile__virtual-scroll {
  padding: 10px;
  height: 250px;
  grid-column-start: 3;
  grid-column-end: 4;
}
</style>
