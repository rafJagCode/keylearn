<template>
  <v-app>
    <v-toolbar>
        <v-toolbar-title>KeyLearn</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items>
            <v-btn text to='/'>Home</v-btn>
            <v-btn text to='/about'>About</v-btn>
        </v-toolbar-items>
    </v-toolbar>
    <router-view></router-view>
  </v-app>
</template>

<script>
export default {
  name: "Test"
};
</script>