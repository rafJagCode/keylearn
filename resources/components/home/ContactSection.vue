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
                <v-tooltip top>
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn
                      :disabled="!valid"
                      color="primary"
                      :dark="valid"
                      rounded
                      block
                      class="mt-3"
                      v-bind="attrs"
                      v-on="on"
                    >
                      Send Message
                    </v-btn>
                  </template>
                  <span>The contact form is not currently supported. It is for illustrative purposes only.</span>
                </v-tooltip>
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
      (v) => !!v || 'Name field is required',
      (v) => (v && v.length >= 6) || 'Name field must contain at least 6 characters',
    ],
    email: '',
    emailRules: [
      (v) => !!v || 'Email fiels is required',
      (v) => /.+@.+\..+/.test(v) || 'Provided email has invalid format',
    ],
    textArea: '',
    textAreaRules: [
      (v) => !!v || 'Message can not be empty',
      (v) => (v && v.length >= 10) || 'Message should contain at least 10 characters',
    ],
    lazy: false,
  }),
};
</script>
