<template>
    <div class="sign" :class="states[state]">
        {{sign}}
    </div>
</template>
<script>
export default {
    data: () =>({
        states: {
            none: 'sign--none',
            current: 'sign--current',
            correct: 'sign--correct',
            incorrect: 'sign--incorrect'
        }
    }),
    props:{
        sign: '',
        state: {
            default: 'none'
        }
    }
}
</script>
<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap');
    .sign{
        font-size:20px;
        color:#E2DADB;
        font-family: 'Share Tech Mono', monospace;
        border-radius: 10%;
        margin: 0.5px;
        width: 20px;
        height: 30px;
        text-align: center;
        vertical-align: middle;
    }
    .sign--none{
        background-color:  #252C55;
    }
    .sign--current{
        border-bottom: 2px solid #52C6F4;
    }
    .sign--correct{
        background-color: green;
        
    }
    .sign--incorrect{
        background-color: #CF1259 ;
        
    }
</style>
