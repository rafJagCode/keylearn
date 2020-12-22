<template>
  <v-app id="test">
    <v-navigation-drawer
      app
      class="pa-0"
      color="secondary"
      expand-on-hover
      permanent
    >
        <v-list-item class="px-2">
            <v-list-item-avatar>
                <v-img :src="require('@/assets/img/parrot.svg')"></v-img>
            </v-list-item-avatar>
            <v-list-item-content>
                <v-list-item-title class="primaryLight--text font-weight-bold" >
                    Not logged in
                </v-list-item-title>
            </v-list-item-content>
        </v-list-item>
        <v-list rounded dense class="text-h4">
            <v-hover v-slot="{ hover }" v-for="(item, index) in items" :key="index">
                <v-list-item class="px-2" :class="{'list--hover':hover}" link @click.prevent="goTo(item.link)">
                    <v-list-item-icon>
                        <v-icon medium color="primaryLight">{{item.icon}}</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title class="primaryLight--text font-weight-bold" >
                            {{item.text}}
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-hover>
        </v-list>
    </v-navigation-drawer>

    <v-main>
      <v-container style="max-width: 700px;">
            <v-row class="justify-center">
                <stopwatch></stopwatch>
            </v-row>
            <v-row>
                <sign
                v-for="(sign, index) in signs" 
                :key="index" :sign="sign" 
                :state="checkTypedSigns[index]"></sign>
            </v-row>
            <v-row>
                <v-text-field
                    class="mt-6 white--text"               
                    label="Click here to start your test"
                    outlined
                    loading
                    dark
                    placeholder="..."
                    color="white"
                    @input="startTest()"
                    v-model="typed">
                        <template v-slot:progress>
                            <v-progress-linear
                                :value="progress"
                                :color="color"
                                absolute
                                height="7"
                            ></v-progress-linear>
                        </template>
                </v-text-field>
            </v-row>
            <v-row>
                <test-results></test-results>
            </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import stopwatch from '@/components/utils/Stopwatch';
import sign from '@/components/utils/Sign';
import testResults from '@/components/utils/TestResults';
export default {
    data: () =>({
        text: `Stoi na stacji lokomotywa`,
         states:{
            none: 'none',
            current: 'current',
            correct: 'correct',
            incorrect: 'incorrect'
        },
        typed: '',
        items:[
            {
                link: 'login',
                icon: 'mdi-account-outline',
                text: 'Login'
            },
            {
                link: 'home',
                icon: 'mdi-home-outline',
                text: 'Home'
            },
        ]

        
    }),
    watch:{
        typed:function(typed){
            if(typed.length>=this.text.length){
              this.$store.dispatch('stopClock');
              this.$store.dispatch('endTest');  
            } 
        }
    },
    computed:{
        signs(){
            return this.text.replace(/(\r\n|\n|\r)/g,"").split("");
        },
        checkTypedSigns(){
            let compare = [];
            let typedSigns = this.typed.split("");
            this.signs.forEach((sign, index)=>{
                if(index===typedSigns.length) compare.push(this.states.current);
                else if(index>typedSigns.length) compare.push(this.states.none);
                else if(sign!==typedSigns[index]) compare.push(this.states.incorrect);
                else compare.push(this.states.correct);
            });
            compare.push(this.states.current);
            return compare;
        },
        progress () {
            return this.typed.length/this.text.length*100;
        },
        color () {
            return ['error', 'warning', 'success'][Math.floor(this.progress / 40)]
        },
    },
    methods:{
        goTo(link){
            this.$router.push({name: link});
        },
        startTest(){
            this.$store.dispatch('startClock');
        }
    },
    components: {
        sign, stopwatch, 'test-results': testResults
    }
}
</script>
<style scoped>
    #test{
        background-color: #252C55;
    }
    .list--hover{
        background-color: #323C71;
    }
</style>
