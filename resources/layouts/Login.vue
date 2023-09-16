<template>
  <v-container fill-height class="register">
    <div class="d-flex flex-column flex-grow-1">
      <v-layout row wrap align-center justify-center>
        <v-flex xs12 sm6>
          <v-alert border="top" color="blue-grey darken-1" dark class="mb-6">
            You can register a new account or login on an account created for demo purposes with this credentials:
            <br />
            email: test@test.com
            <br />
            password: test123
          </v-alert>
          <v-card elevation="5" outlined>
            <v-container class="register__label primary">
              <v-row align="center">
                <router-link to="/" style="text-decoration: none; color: inherit">
                  <v-btn class="white--text home-btn ml-4" outlined color="cyan">
                    <v-icon>mdi-home-outline</v-icon>
                  </v-btn>
                </router-link>
                <v-spacer></v-spacer>
                <img class="register__logo" src="@/assets/img/logo.png" alt="Logo" />
              </v-row>
            </v-container>
            <v-alert class="ma-1" prominent type="error" v-if="error">
              <v-row align="center"> {{ error }} </v-row>
            </v-alert>
            <v-form class="ma-6" ref="form" v-model="valid" lazy-validation>
              <v-text-field v-model="email" :rules="emailRules" label="E-mail" validate-on-blur></v-text-field>
              <v-text-field
                v-model="password"
                type="password"
                :rules="passwordRules"
                label="Password"
                validate-on-blur
              ></v-text-field>
              <v-btn
                class="signup-btn primary--text mt-8"
                type="submit"
                outlined
                rounded
                block
                @click.prevent="handleSubmit()"
                >Login</v-btn
              >
            </v-form>
          </v-card>
          <v-card class="mt-2 pa-6">
            <v-row align="center" justify="center">
              <div class="sign-up-text">
                Don't have account?
                <v-icon>mdi-arrow-right</v-icon>
                <router-link to="/register" style="text-decoration: none; color: inherit">
                  <v-btn color="primary">
                    <strong>Sign Up</strong>
                  </v-btn>
                </router-link>
              </div>
            </v-row>
          </v-card>
        </v-flex>
      </v-layout>
    </div>
  </v-container>
</template>
<script>
export default {
  data: () => ({
    error: null,
    valid: true,
    email: 'test@test.com',
    password: 'test123',
    emailRules: [(v) => !!v || 'E-mail is required', (v) => /.+@.+\..+/.test(v) || 'E-mail must be valid'],
    passwordRules: [(v) => !!v || 'Password is required'],
  }),
  methods: {
    handleSubmit() {
      this.error = null;
      if (!this.$refs.form.validate()) return;
      this.$store
        .dispatch('signIn', { email: this.email, password: this.password })
        .then(() => {
          this.$router.push({ name: 'dashboard' });
        })
        .catch((error) => {
          this.error = error.response.data.message;
        });
    },
  },
};
</script>
<style scoped>
.register {
  background-image: url('~@/assets/img/bg-keyboard.jpg');
  background-repeat: no-repeat;
  background-size: cover;
}
.register__label {
  height: 80px;
  display: flex;
  align-items: center;
}
.register__logo {
  margin-right: 20px;
  height: 50px;
  background-size: cover;
}
.home-btn:hover {
  background-color: #1f7192;
  transition: 0.3s;
}
.signup-btn {
  background-color: #effaff;
  transition: 0.3s;
}
.signup-btn:hover {
  color: #effaff !important;
  background-color: #07506e;
  transition: 0.3s;
}
</style>
