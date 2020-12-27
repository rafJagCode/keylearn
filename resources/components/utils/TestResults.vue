<template>
    <v-container>
        <v-layout row>
            <v-col v-for="(result, index) in testResults" :key="index"
            cols="6"
            sm="4"
            class="my-4"
            >
                <v-card
                height="80"
                width="200"
                color="#D4D8EC"
                >
                    <v-layout row>
                        <v-sheet 
                        color="teal"
                        elevation="10"
                        height="80"
                        width="80"
                        rounded
                        class="icon"
                        >
                            <v-layout align-center justify-center fill-height>
                                <v-icon x-large>{{result.icon}}</v-icon>
                            </v-layout>
                        </v-sheet>
                        <v-layout column align-center justify-center>
                            <div class="name">{{result.title}}</div> 
                            <div class="value">{{result.value}}</div> 
                        </v-layout>
                    </v-layout>
                </v-card>
            </v-col>
        </v-layout>
    </v-container>
</template>
<script>
export default {
    data: ()=>({
        testResults:[]
    }),
    mounted:function(){
        let seconds = this.textToSeconds(this.$store.getters.finalTime);
        let cpm = this.$store.getters.amountOfSigns * 60 / seconds;
        let wpm = cpm/5;
        let accuracy = (this.$store.getters.amountOfSigns - this.$store.getters.errors) / this.$store.getters.amountOfSigns * 100;
        this.testResults = [
            {
                title: 'Time',
                value: this.$store.getters.finalTime,
                icon: 'mdi-clock-time-four-outline'
            },
            {
                title: 'Test Lenght',
                value: this.$store.getters.amountOfSigns,
                icon: 'mdi-ruler'
            },
            {
                title: 'Errors',
                value: this.$store.getters.errors,
                icon: 'mdi-alert-outline'
            },
            {
                title: 'CPM',
                value: Math.round(cpm),
                icon: 'mdi-speedometer'
            },
            {
                title: 'WPM',
                value: Math.round(wpm),
                icon: 'mdi-speedometer'
            },
            {
                title: 'Accuracy',
                value: Math.round(accuracy) + '%',
                icon: 'mdi-bullseye-arrow'
            }
        ]
    },
    methods:{
        textToSeconds(text){
            let textDivided = text.split(':');
            let seconds = parseFloat(textDivided[0]) * 3600 + parseFloat(textDivided[1]) * 60 + parseFloat(textDivided[2]);
            return seconds;
        }
    }
}
</script>
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap');

.icon{
    position: relative;
    top:-20px;
    left:20px;
}
.name{
    font-family: 'Luckiest Guy', cursive;
}
.value{
    font-family: 'Luckiest Guy', cursive;
    font-size: 15px;
}
</style>