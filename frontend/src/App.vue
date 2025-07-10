<template>
  <div id="app">
    <BackgroundStars />
    <FloatingShapes />
    <AppHeader />
    <router-view />
  </div>
</template>

<script>
import AppHeader from './components/AppHeader.vue'
import BackgroundStars from './components/BackgroundStars.vue'
import FloatingShapes from './components/FloatingShapes.vue'

export default {
  components: { AppHeader, BackgroundStars, FloatingShapes },
}
</script>

<style>
@import '@/assets/styles/main.css';

#app {
  font-family: 'Montserrat', sans-serif;
  margin: 0;
  padding: 0;
  position: relative;
  overflow: hidden;
  min-height: 100vh;
}
</style>