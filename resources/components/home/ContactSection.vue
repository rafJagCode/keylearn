<template>
  <section class="pb-12" id="contact">
    <v-container fluid>
      <v-row align="center" justify="center">
        <v-col cols="10">
          <v-row justify="center">
            <v-col cols="12" sm="5">
              <h1 class="font-weight-light display-1">Contact Us</h1>
              <h3 class="font-weight-light mt-3">
                You have questions, need help or have found a mistake? Then do not hesitate to contact us.
              </h3>
              <h3 class="font-weight-light mt-3">Telephone: +xx xxx-xxx-xxx</h3>
              <h3 class="font-weight-light">Email: email@email.com</h3>
            </v-col>
            <v-col cols="12" sm="7">
              <v-form ref="form" v-model="valid" :lazy-validation="lazy">
                <v-text-field v-model="name" :counter="10" :rules="nameRules" label="Name" required></v-text-field>

                <v-text-field v-model="email" :rules="emailRules" label="E-mail" required></v-text-field>

                <v-textarea v-model="textArea" :rules="textAreaRules" label="Message" required />

                <v-btn :disabled="!valid" color="primary" :dark="valid" rounded block class="mt-3">
                  Send Message
                </v-btn>
              </v-form>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
    <div class="svg-border-waves text-white">
      <v-img :src="require('@/assets/img/borderWavesBlue.svg')" />
    </div>
  </section>
</template>

<style scoped>
#contact {
  background-color: white;
}

.svg-border-waves .v-image {
  position: absolute;
  bottom: 0;
  left: 0;
  height: 3rem;
  width: 100%;
  overflow: hidden;
}
</style>

<script>
export default {
  data: () => ({
    icons: ['fa-facebook', 'fa-twitter', 'fa-linkedin', 'fa-instagram'],
    valid: true,
    name: '',
    nameRules: [
      (v) => !!v || 'O campo nome é obrigatório',
      (v) => (v && v.length >= 6) || 'O nome precisa ter mais de 6 caracteres',
    ],
    email: '',
    emailRules: [
      (v) => !!v || 'O campo email é obrigatório',
      (v) => /.+@.+\..+/.test(v) || 'O E-mail precisa ser válido',
    ],
    textArea: '',
    textAreaRules: [
      (v) => !!v || 'O campo de texto é obrigatório',
      (v) => (v && v.length >= 10) || 'Mínimo de 10 caracteres',
    ],
    lazy: false,
  }),
};
</script>
