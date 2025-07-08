<template>
  <div id="app">
    <div class="star-background"></div>
    <!-- <img class="custom-shape main_figure" :src="mainFigure" alt="Main Figure"> -->

    <AppHeader />
    <router-view />
  </div>
</template>

<script>
import AppHeader from './components/AppHeader.vue'
import mainFigure from '@/assets/images/main_figure.svg'

export default {
  components: {
    AppHeader,
  },
  data() {
    return {
      mainFigure,
    }
  },
}
</script>

<style>
@import '@/assets/styles/main.css';

#app {
  font-family: 'Montserrat', sans-serif;
  background-image: url('src/assets/images/stars.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  min-height: 150vh;
  margin: 0;
  padding: 0;
  overflow-x: hidden;
  position: relative;
}
/*
.custom-shape {
  position: absolute;
}

.main-figure {
  right: 0;
  top: 0;
}*/
</style>
