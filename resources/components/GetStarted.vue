<template>
  <section id="get-started">
    <v-parallax dark :src="require('@/assets/img/bgHero.jpg')" height="750">
      <v-row align="center" justify="center">
        <v-col cols="10">
          <v-row align="center" justify="center">
            <v-col cols="12" md="6" xl="8">
              <h1 class="display-2 font-weight-bold mb-4">KeyLearn</h1>
              <h1 class="font-weight-light">
                Lorem ipsum dolor sit amet consectetur <br />
                adipisicing elit. Maiores porro voluptatibus <br />
                delectus nam optio harum!
              </h1>
              <v-btn
                rounded
                outlined
                large
                dark
                @click="$vuetify.goTo('#features')"
                class="mt-5"
              >
                Get Started
                <v-icon class="ml-2">mdi-arrow-down</v-icon>
              </v-btn>
            </v-col>
            <v-col cols="12" md="6" xl="4" class="hidden-sm-and-down"> </v-col>
          </v-row>
        </v-col>
      </v-row>
      <div class="svg-border-waves text-white">
        <v-img :src="require('@/assets/img/borderWaves.svg')" />
      </div>
    </v-parallax>
    <v-container fluid id="features" class="mt-2">
      <v-row align="center" justify="center">
        <v-col cols="10">
          <v-row align="center" justify="space-around">
            <v-col
              cols="12"
              sm="4"
              class="text-center"
              v-for="(card, index) in cards"
              :key="index"
            >
            <about-card size="400" :icon="card.icon" :caption="card.caption" :description="card.description"></about-card>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
  </section>
</template>

<script>
import aboutCard from '@/components/utils/AboutCard';
export default {
  data() {
    return {
      cards: [
        {
          icon: "sign-up-icon",
          caption: "sign up",
          description: "Creating account will allow you to control your learning progress. Sign up to get access to your learning statistics.",
        },
        {
          icon: "typing-practice-icon",
          caption: "practice typing",
          description: "Start your training. Check how fast and accurate is your typing.",
        },
        {
          icon: "graph-bar",
          caption: "practice typing",
          description: "Start your training. Check how fast and accurate is your typing.",
        },
      ],
    };
  },
  components: {
    'about-card': aboutCard
  }
};
</script>


<style>

.svg-border-waves .v-image {
  position: absolute;
  bottom: 0;
  left: 0;
  height: 3rem;
  width: 100%;
  overflow: hidden;
}

#get-started {
  z-index: 0;
}

</style>

<style>
section {
  position: relative;
}
</style>
