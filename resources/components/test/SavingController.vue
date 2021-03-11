<template>
  <div
    id="saving-controller"
    style="
       {
        width: 300px;
      }
    "
  >
    <Keypress
      key-event="keyup"
      :key-code="83"
      :modifiers="['ctrlKey', 'shiftKey']"
      @success="handleCtrlShiftSKeypress()"
    />
    <v-row justify="center">
      <div class="icon-container">
        <v-progress-circular
          class="saving-loader"
          v-if="isSavingInProgress"
          :size="55"
          color="green"
          indeterminate
        ></v-progress-circular>
        <v-icon :color="color" x-large class="mx-4">mdi-content-save</v-icon>
      </div>
      <v-layout
        column
        justify-center
        align-center
        class="primaryLight--text text-caption"
      >
        <v-row class="saving-result creamy--text" v-if="savedSuccessfully" justify="center" align="center" @click="undoSave()">
          <v-icon left color="creamy">mdi-undo</v-icon>
          <span>Undo Save</span>
        </v-row>
        <v-row class="saving-result saving-result--unsuccsessfull primaryRed--text" v-if="savedUnsuccessfully" justify="center" align="center" @click="saveTestResults()">
          <v-icon left color="primaryRed">mdi-refresh</v-icon>
          <span>Retry Saving</span>
        </v-row>
        <span> {{ text1 }} </span>
        <span> {{ text2 }} </span>
      </v-layout>
    </v-row>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      isSavingEnabled: true,
      isSavingInProgress: false,
      lastSavedTest: null,
      savedSuccessfully: false,
      savedUnsuccessfully: false,
    };
  },
  watch: {
    isTestRunning: function (isTestRunning) {
      if (!isTestRunning && this.isUserAuthenticated && this.isSavingEnabled)
        this.saveTestResults();
      if(isTestRunning) this.clearData();
    },
  },
  computed: {
    ...mapGetters([
      "user",
      "isUserAuthenticated",
      "isTestRunning",
      "testResults",
    ]),
    color() {
      if (this.isSavingEnabled && this.isUserAuthenticated) return "green";
      return "primaryRed";
    },
    text1() {
      if (this.isUserAuthenticated) return "Press CTRL + SHIFT + S";
      return "LOG IN";
    },
    text2() {
      if (this.isUserAuthenticated) return "TO TURN ON/OFF RESULT SAVING";
      return "TO SAVE YOUR RESULTS";
    },
  },
  components: {
    Keypress: () => import("vue-keypress"),
  },
  methods: {
    clearData(){
      this.savedSuccessfully = false;
      this.savedUnsuccessfully = false;
      this.lastSavedTest = null;
    },
    handleCtrlShiftSKeypress() {
      if (!this.isUserAuthenticated) return;
      this.isSavingEnabled = !this.isSavingEnabled;
    },
    saveTestResults() {
      this.isSavingInProgress = true;
      Vue.axios
        .post("/api/save-test-results", {
          ...this.testResults,
          profile_id: this.user.selected_profile_id,
        })
        .then((res) => {
          this.isSavingInProgress = false;
          this.savedSuccessfully = true;
          this.lastSavedTest = res.data;
        })
        .catch(() => {
          this.isSavingInProgress = false;
          this.savedUnsuccessfully = true;
        });
    },
    undoSave(){
      this.isSavingInProgress = true;
      Vue.axios.post('/api/delete-test-results', this.lastSavedTest).then(()=>{
        this.savedSuccessfully = false;
        this.isSavingInProgress = false;
      })
    }
  },
};
</script>
<style scoped>
.icon-container {
  position: relative;
}
.saving-result{
  position: absolute;
  transform: translate(0,-150%);
  cursor: pointer;
  border: 0.1px solid #E2DADB;
  border-radius: 5px;
  opacity: 0.8;
  padding: 0 10px;
}
.saving-result:hover{
  opacity: 1;
}
.saving-result--unsuccsessfull{
  border: 0.1px solid #cf1259;
}
.saving-loader {
  position: absolute;
  transform: translate(-50%,-50%);
  left: 50%;
  top: 50%;
}
</style>