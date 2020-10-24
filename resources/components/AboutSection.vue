<template>
  <section id="about">
    <div class="wave-rotated">
      <v-img :src="require('@/assets/img/wave2.svg')" />
    </div>
    <v-container fluid>
      <v-row align="center" justify="center">
        <v-col cols="10">
          <v-row align="center" justify="center">
            <v-col sm="4" class="hidden-xs-only">
              <v-img :src="require('@/assets/img/ill2.svg')" class="keyboard-icon d-block ml-auto mr-auto" max-width="350px" />
            </v-col>
            <v-col cols="12" sm="8" class="white--text text-left">
              <h1 class="font-weight-light display-2 mb-2">Baixar Demonstração</h1>
              <h1 class="font-weight-light">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste ex
                animi quod laboriosam vel blanditiis labore alias, aliquid,
                tempora repellendus non.
              </h1>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
    <div class="svg-border-waves text-white">
      <v-img :src="require('@/assets/img/borderWaves.svg')" />
    </div>
  </section>
</template>

<style scoped>
#about {
  background-image: url("~@/assets/img/bgAbout.jpg");
  background-attachment: fixed;
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  height: 500px;
}

#about .container,
#about .row {
  height: 100%;
}
.wave-rotated{
  position: absolute;
  width:100%;
}
.wave-rotated .v-image{
  height:400px;
}
.keyboard-icon{
  height:300px;
  width:300px;
}
</style>
