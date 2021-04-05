<template>
  <div class="page-not-found">
    <div class="bg-purple">
      <div class="stars">
        <div class="brand-logo">
          <v-img :src="require('@/assets/img/logo.png')" width="80px" />
        </div>
        <v-layout align-center column class="central-body primaryLight--text">
          <span class="text-h1">404</span>
          <span class="central-text text-subtitle2">
            The page you are trying to get to never existed in this reality, or has migrated to a parallel
            universe.</span
          >
          <span class="mt-6 central-text text-caption">
            It is however possible that you have made a typing mistake, in that case clicking below will get you to a
            place that will help you reduce the likelihood of that kind of events in the future.</span
          >
          <v-btn outlined text dark class="mt-4" @click="$router.push({ name: 'home' })">CLICK</v-btn>
        </v-layout>
        <div class="objects">
          <v-img class="object_ufo" :src="require('@/assets/img/ufo.png')" width="80px" />
          <div class="jupiter-europa">
            <v-img class="object_jupiter" :src="require('@/assets/img/jupiter.png')" width="100px" />
            <img class="object_europa" :src="require('@/assets/img/europa.png')" width="20px" />
          </div>
          <div class="box_alien">
            <v-img class="object_alien" :src="require('@/assets/img/alien.png')" width="140px" />
          </div>
        </div>
        <div class="glowing_stars">
          <div class="star"></div>
          <div class="star"></div>
          <div class="star"></div>
          <div class="star"></div>
          <div class="star"></div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
@-moz-keyframes rocket-movement {
  100% {
    -moz-transform: translate(1980px, -1080px);
  }
}
@-webkit-keyframes rocket-movement {
  100% {
    -webkit-transform: translate(1980px, -1080px);
  }
}
@keyframes rocket-movement {
  100% {
    transform: translate(1980px, -1080px);
  }
}
@-moz-keyframes spin-jupiter {
  100% {
    -moz-transform: rotate(-360deg);
    transition: transform 20s;
  }
}
@-webkit-keyframes spin-jupiter {
  100% {
    -webkit-transform: rotate(-360deg);
    transition: transform 20s;
  }
}
@keyframes spin-jupiter {
  100% {
    -webkit-transform: rotate(-360deg);
    transform: rotate(-360deg);
    transition: transform 20s;
  }
}

@-moz-keyframes move-alien {
  100% {
    -moz-transform: translate(-160px, -160px);
  }
}
@-webkit-keyframes move-alien {
  100% {
    -webkit-transform: translate(-160px, -160px);
  }
}
@keyframes move-alien {
  100% {
    -webkit-transform: translate(-160px, -160px);
    transform: translate(-160px, -160px);
  }
}
@-moz-keyframes rotate-alien {
  100% {
    -moz-transform: rotate(-720deg);
  }
}
@-webkit-keyframes rotate-alien {
  100% {
    -webkit-transform: rotate(-720deg);
  }
}
@keyframes rotate-alien {
  100% {
    -webkit-transform: rotate(-720deg);
    transform: rotate(-720deg);
  }
}

@-moz-keyframes glow-star {
  40% {
    -moz-opacity: 0.3;
  }
  90%,
  100% {
    -moz-opacity: 1;
    -moz-transform: scale(1.2);
  }
}
@-webkit-keyframes glow-star {
  40% {
    -webkit-opacity: 0.3;
  }
  90%,
  100% {
    -webkit-opacity: 1;
    -webkit-transform: scale(1.2);
  }
}
@keyframes glow-star {
  40% {
    -webkit-opacity: 0.3;
    opacity: 0.3;
  }
  90%,
  100% {
    -webkit-opacity: 1;
    opacity: 1;
    -webkit-transform: scale(1.2);
    transform: scale(1.2);
    border-radius: 999999px;
  }
}

.spin-jupiter-on-hover {
  transition: ease 200s !important;
  transform: rotate(-3600deg) !important;
}

.page-not-found {
  height: 100vh;
}

.bg-purple {
  background: url('~@/assets/img/404bg.png');
  background-repeat: repeat-x;
  background-size: cover;
  background-position: left top;
  height: 100%;
  overflow: hidden;
}

.brand-logo {
  margin-left: 25px;
  margin-top: 5px;
  display: inline-block;
}

.central-body {
  padding: 17% 5% 10% 5%;
  text-align: center;
}
.central-text {
  width: 400px;
}

.objects img {
  z-index: 90;
  pointer-events: none;
}

.object_ufo {
  z-index: 95;
  position: absolute;
  transform: translateX(-50px);
  top: 75%;
  pointer-events: none;
  animation: rocket-movement 100s linear infinite both running;
}

.object_jupiter {
  position: absolute;
  top: 20%;
  left: 15%;
  z-index: 90;
  animation: spin-jupiter 100s infinite linear both;
}

.object_europa {
  position: absolute;
  top: 12%;
  left: 25%;
}

.object_alien {
  animation: rotate-alien 200s infinite linear both alternate;
}

.box_alien {
  z-index: 110 !important;
  position: absolute;
  top: 60%;
  right: 20%;
  will-change: transform;
  animation: move-alien 50s infinite linear both alternate;
}

.stars {
  background: url('~@/assets/img/overlay_stars.svg');
  background-repeat: repeat;
  background-size: contain;
  background-position: left top;
}

.glowing_stars .star {
  position: absolute;
  border-radius: 100%;
  background-color: #fff;
  width: 3px;
  height: 3px;
  opacity: 0.3;
  will-change: opacity;
}

.glowing_stars .star:nth-child(1) {
  top: 80%;
  left: 25%;
  animation: glow-star 2s infinite ease-in-out alternate 1s;
}
.glowing_stars .star:nth-child(2) {
  top: 20%;
  left: 40%;
  animation: glow-star 2s infinite ease-in-out alternate 3s;
}
.glowing_stars .star:nth-child(3) {
  top: 25%;
  left: 25%;
  animation: glow-star 2s infinite ease-in-out alternate 5s;
}
.glowing_stars .star:nth-child(4) {
  top: 75%;
  left: 80%;
  animation: glow-star 2s infinite ease-in-out alternate 7s;
}
.glowing_stars .star:nth-child(5) {
  top: 90%;
  left: 50%;
  animation: glow-star 2s infinite ease-in-out alternate 9s;
}

@media only screen and (max-width: 600px) {
  .navbar-links {
    display: none;
  }

  .custom-navbar {
    text-align: center;
  }

  .brand-logo img {
    width: 120px;
  }

  .box_alien {
    top: 70%;
  }

  .central-body {
    padding-top: 25%;
  }
}
</style>
