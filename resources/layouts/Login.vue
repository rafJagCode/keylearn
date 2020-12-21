<template>
    <v-container fill-height class="register">
      <v-layout row wrap align-center> 
        <v-flex xs12 sm6 offset-sm3>
          <v-card 
          elevation="5"
          outlined
          >
            <v-container class="register__label primary">
              <v-row align="center">
                <router-link to="/" style="text-decoration: none; color: inherit;">
                  <v-btn class="white--text home-btn ml-4" outlined color="cyan">
                    <v-icon>mdi-home-outline</v-icon>
                  </v-btn>
                </router-link>
                <v-spacer></v-spacer>
                <img 
                class="register__logo"
                src="@/assets/img/logo.png" 
                alt="Logo"
                />
              </v-row>
            </v-container>
            <v-form
              class="ma-6"
              ref="form"
              v-model="valid"
              lazy-validation
            >
          
              <v-text-field
                v-model="email"
                :rules="emailRules"
                label="E-mail"
                @focus="focusEmail()"
              ></v-text-field>
              <v-text-field
                v-model="password"
                type="password"
                :rules="passwordRules"
                label="Password"
                @focus="focusPassword"
              ></v-text-field>
              <v-btn 
              class="signup-btn primary--text mt-8"
              type="submit"
              outlined
              rounded
              block
              @click.prevent="handleSubmit()"
              >Login</v-btn>
          
            </v-form>
          </v-card>
          <v-card class="mt-2 pa-6">
            <v-row align="center" justify="center">
              <div class="sign-up-text">
                Don't have account?
                <v-icon>mdi-arrow-right</v-icon>
                <router-link to="/register" style="text-decoration: none; color: inherit;">
                  <v-btn color='primary'>
                    <strong>Sign Up</strong>
                  </v-btn>
                </router-link>
              </div>
            </v-row>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
</template>
<script>
export default {
  data: () => ({
    valid: true,
    email: '',
    password: "",
    emailRules: [],
    passwordRules: [],
  }),

  methods: {
    checkValidation(){
      this.emailRules= [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ];
      this.passwordRules= [
        v => !!v || 'Password is required',
      ];
      return true;
    },
    async handleSubmit(){
      await this.checkValidation();
      if(!this.$refs.form.validate()) return;
      Vue.axios.post('api/login', {email:this.email, password:this.password}).then(()=>{
        this.$router.push({ name: 'dashboard'});
      }).catch((error)=>{
        this.errors = error.response.data.errors;
      });
    },
    focusEmail(){
      this.emailRules=[];
    },
    focusPassword(){
      this.passwordRules=[];
    },
    focusPasswordConfirmation(){
      this.comparePasswords = [];
    },
  }
}
</script>
<style scoped>
.register{
    background-image: url("~@/assets/img/bg-keyboard.jpg");
    background-repeat: no-repeat;
    background-size: cover;
}
.register__label{
  height:80px;
}
.register__logo{
  margin-right:20px;
  height:50px;
  background-size:cover;
}
.home-btn:hover{
  background-color: #1f7192;
  transition: 0.3s;
}
.signup-btn{
  background-color: #effaff;
  transition: 0.3s;
}
.signup-btn:hover{
  color: #effaff!important;
  background-color: #07506e;
  transition: 0.3s;
}
</style>