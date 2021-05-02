<template>
  <div class="no-data">
    <v-img class="no-data__img" contain :src="require('@/assets/img/sorry.svg')"></v-img>
    <div class="no-data__text-container">
      <div class="no-data__title">Nothing to display at this moment</div>
      <div class="no-data__text">Try to type few tests and check again</div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style lang="css" scoped>
.no-data {
  margin: auto;
  height: 500px;
  width: 700px;
  display: flex;
  flex-wrap: wrap;
  align-content: center;
}
.no-data__img {
  flex-basis: 30%;
}
.no-data__text-container {
  flex-basis: 70%;
  display: grid;
  padding-left: 20px;
}
.no-data__title {
  align-self: end;
  font-size: 25px;
}
</style>
