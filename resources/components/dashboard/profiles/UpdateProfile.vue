<template>
  <v-container class="create-profile">
    <v-snackbar v-model="updated" :timeout="1000" centered>
      <v-row align="center" justify="space-around">
        <span class="ml-3">Profile Updated</span>
        <v-spacer></v-spacer>
        <v-btn text color="primaryLight" @click.native="updated = false">Close</v-btn>
      </v-row>
    </v-snackbar>
    <profile-list class="mb-8"></profile-list>
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
      <v-progress-circular v-if="updating" indeterminate color="primaryLight" class="mr-2"></v-progress-circular>
      <v-btn @click="updateProfile()">Update Profile</v-btn>
    </v-row>
  </v-container>
</template>
<script>
import ProfileList from '@/components/dashboard/profiles/ProfileList';
import { mapGetters } from 'vuex';
export default {
  components: {
    ProfileList,
  },
  data() {
    return {
      updated: false,
      updating: false,
      error: null,
      wordsField: '',
      wordsToAdd: [],
      profileName: '',
      wordSelection: 'random',
      isAutoDifficultyEnabled: false,
      testLength: 50,
      rules: [(value) => !!value || 'Required.', (value) => (value || '').length <= 20 || 'Max 20 characters'],
    };
  },
  watch: {
    useWordsFromApi: function (useWordsFromApi) {
      if (!useWordsFromApi) return;
      this.isAutoDifficultyEnabled = false;
    },
    watchedProfile: {
      handler: 'updateData',
      immediate: true,
    },
  },
  computed: {
    ...mapGetters(['watchedProfile']),
    useWordsFromApi() {
      return this.wordSelection === 'random' ? true : false;
    },
  },
  methods: {
    updateData() {
      this.profileName = this.watchedProfile.name;
      this.testLength = this.watchedProfile.test_length;
      this.wordSelection = this.watchedProfile.use_words_from_api ? 'random' : 'defined';
      this.isAutoDifficultyEnabled = this.watchedProfile.auto_difficulty;
      this.wordsToAdd = this.watchedProfile.words.map((word) => word.word);
    },
    updateProfile() {
      this.error = null;
      this.updating = true;
      Vue.axios
        .post('/api/update-profile', {
          name: this.profileName,
          words: this.wordsToAdd,
          useWordsFromApi: this.useWordsFromApi,
          isAutoDifficultyEnabled: this.isAutoDifficultyEnabled,
          testLength: this.testLength,
          id: this.watchedProfile.id,
        })
        .then(() => {
          this.$store.dispatch('setProfiles');
          this.updated = true;
        })
        .catch((error) => {
          this.error = error.response.data.message;
        });
      this.updating = false;
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
  background-color: transparent;
  position: relative;
  z-index: 0;
}
.create-profile__user-words::before {
  content: '';
  height: 100%;
  width: 100%;
  background-color: rgba(255, 255, 255, 0.7);
  filter: blur(40px);
  position: absolute;
  z-index: -1;
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
  background-color: transparent;
  z-index: 0;
  position: relative;
}
.create-profile__virtual-scroll::before {
  content: '';
  height: 100%;
  width: 100%;
  position: absolute;
  z-index: -1;
  background-color: rgba(255, 255, 255, 0.7);
  filter: blur(40px);
}
</style>
