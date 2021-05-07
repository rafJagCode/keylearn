<template>
  <v-app>
    <vue-confirm-dialog></vue-confirm-dialog>
    <router-view></router-view>
  </v-app>
</template>
<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap');
* {
  box-sizing: border-box;
  font-family: 'Roboto Slab', serif;
}
#scrollable::-webkit-scrollbar {
  width: 15px;
}

#scrollable::-webkit-scrollbar-track {
  background: #e6e6e6;
  border-left: 1px solid #dadada;
}

#scrollable::-webkit-scrollbar-thumb {
  background: #b0b0b0;
  border: solid 3px #e6e6e6;
  border-radius: 7px;
}

#scrollable::-webkit-scrollbar-thumb:hover {
  background: black;
}
#scrollable {
  scrollbar-width: thin;
}
.v-window.v-item-group.theme--light.v-tabs-items {
  background-color: transparent;
}
</style>
