<template>
    <div class="about-card" :style="scssVars" >
        <div class="about-card__caption">{{caption}}</div>
        <div class="about-card__content">
            <img class="about-card__card-icon" :src="iconPath" :alt="icon">
            <div class="about-card__description">
                <p class="about-card__description-text">{{description}}</p>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .about-card{
        position: relative;
        width: calc(var(--size)*1px);
        height: calc(var(--size)*1px);
        display:flex;
        flex-direction: column;
        margin: 0 auto;
    }
    .about-card__caption{
        font-size: 25px;
        position: absolute;
        align-self: center;
        color: #0095a6;
        text-transform: uppercase;
        text-shadow: -1px -1px 0 white, 1px -1px 0 white, -1px 1px 0 white, 1px 1px 0 white,
                     -1px -1px 5px #0095a6, 1px -1px 5px #0095a6, -1px 1px 5px #0095a6, 1px 1px 5px #0095a6;
        z-index:3;
        font-weight: bold;
    }
    .about-card__description{
        position: absolute;
        top:0;
        width: 100%;
        height: 100%;
        transform: scaleY(0);
        transform-origin: top center;
        transition: all 0.3s linear;
        overflow: hidden;
    }
    .about-card__description-text{
        position: absolute;
        width:90%;
        top: 50%;
        right: 50%;
        transform: translate(50%, -50%);
        margin: 0 auto;
        color: white;
        text-align: center;
        font-size: 20px;
        text-shadow: -1px -1px 0 black, 1px -1px 0 black, -1px 1px 0 black, 1px 1px 0 black,
                    -1px -1px 5px black, 1px -1px 5px black, -1px 1px 5px black, 1px 1px 5px black;      
    }
    .about-card__content{
        align-self: center;
        margin: auto;
        position: relative;
        width: calc(var(--size)*0.8px);
        height: calc(var(--size)*0.8px);
        cursor: pointer;
        z-index:2;
        transition: all 0.3s linear;
        border-radius: 50%;
    }
    .about-card__content:hover .about-card__description{
                animation: dropping-card .3s linear 0s 1 normal;
                animation-fill-mode: forwards;
    }
    .about-card__card-icon{
        position: absolute;
        top: 50%;
        right: 50%;
        transform: translate(50%, -50%);
        width: 80%;
        background-image: var(--iconURL);
        background-size: contain;
        z-index: 0;
    }
    @keyframes dropping-card{
        0% {
            transform: scaleY(0);
        }
        25%{
            transform: scaleY(0.5);
        }
        50%{
            transform: scaleY(1);
        }
        75%{
            transform: scaleY(0.5);
        }
        100%{
            transform: scaleY(1);
        }
    }
</style>
<script>
export default {
    name: "AboutCard",
    props: ['size', 'icon', 'caption', 'description'],
    computed:{
        scssVars(){
            return{
                '--size': this.size,
            }
        },
        iconPath(){
            return require('@/assets/img/' + this.icon + '.svg');
        }
    }
}
</script>