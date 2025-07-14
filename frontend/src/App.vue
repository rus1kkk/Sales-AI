<template>
  <div class="app-container" id="app">
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
  name: 'App',
  components: {
    AppHeader,
    BackgroundStars,
    FloatingShapes,
  },
}
</script>

<style scoped>
@import '@/assets/styles/main.css';

.app-container {
  width: 100%;
  /* height: 100vh; */
  margin: 0;
  padding: 0;
  /* overflow: hidden; */
}

#app {
  font-family: 'Montserrat', sans-serif;
  position: relative;
  min-height: 100vh;
}
</style>
