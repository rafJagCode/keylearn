<template>
  <v-app>
    <v-alert type="warning" :value="true">
      About
    </v-alert>
    <v-container>
      <v-row>
        <v-card class="d-flex justify-center align-center" width="20px">{{count}}</v-card>
        <v-btn color="green" @click="incrementCount">Add</v-btn>
        <v-btn color="red" @click="decrementCount">Remove</v-btn>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import {mapActions, mapGetters} from 'vuex';
export default {
  name: "About",
  computed: mapGetters(['count']),
  methods: mapActions(['incrementCount', 'decrementCount'])
};
</script>